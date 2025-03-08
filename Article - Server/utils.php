<?php

// utils.php

function sendResponse($successResponse, $message) {
    $response = [];
    $response["success"] = $successResponse;
    $response["message"] = $message;
    echo json_encode($response);
    return;
}

function HashingPassword($password) {
    $hashedPassword = hash('sha256', $password);
    return $hashedPassword;
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
}

?>