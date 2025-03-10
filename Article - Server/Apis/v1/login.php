<?php
require_once("../../utils.php");
require_once("../../Models/User.php");
require_once("../../Connection/connection.php");

User::init($conn);

if (isset($data["email"]) && isset($data["password"])) {
    $email = $data["email"];
    $password = $data["password"];

    $hashedPassword = HashingPassword($password);
} else {
    sendResponse(false, "Missing parameters");
}

try {
    $user = User::findByEmail($email);

    if ($user) {
        // if (password_verify($hashedPassword, $user["password"])) {
        if (password_verify($password, $user["password"])) {
        // if ($hashedPassword === $user["password"]) {
            sendResponse(true, "Login successful!");
        } else {
            sendResponse(false, "Incorrect password");
        }
    } else {
        sendResponse(false, "User not found");
    }
} catch (\Throwable $e) {
    http_response_code(400);
    echo json_encode([
        "message" => $e->getMessage()
    ]);
}

?>
