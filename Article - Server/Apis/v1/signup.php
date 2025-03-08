<?php
// signup.php
include("../../utils.php");
require("../../Connection/connection.php");
include("../../Models/User.php");
include("../../Database/Migrations/UserTable.php");

if(isset($data["fullname"]) && isset($data["email"]) && isset($data["password"])) {
    $name = $data["fullname"];
    $email = $data["email"];
    $password = $data["password"];

    // $hashed = password_hash($password, PASSWORD_BCRYPT);

} else {
    sendResponse(false, "Missing parameters");
}

// $user = new Users($conn);
User::init($conn);
$user = new User();

try{
    UserTable::up();
    // $result = $user->create($name, $email, $hashed);
    $result = $user->create($name, $email, $password);
    $response = $result ? sendResponse(true, "User created!") : sendResponse(false, "Failed to create User");
}catch (\Throwable $e) {
    http_response_code(400);

    echo json_encode([
        "message" => $e->getMessage()
    ]);
}

// echo json_encode($response);
?>
