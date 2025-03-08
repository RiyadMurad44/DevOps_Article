<?php
// signup.php
require_once("../../utils.php");
require_once("../../Models/User.php");
require_once("../../Models/Question.php");
require_once("../../Connection/connection.php");
require_once("../../Database/Migrations/UserTable.php");
require_once("../../Database/Seeds/Table_data_Seeds.php");
require_once("../../Database/Migrations/QuestionTable.php");

if(isset($data["fullname"]) && isset($data["email"]) && isset($data["password"])) {
    $name = $data["fullname"];
    $email = $data["email"];
    $password = $data["password"];

} else {
    sendResponse(false, "Missing parameters");
}

User::init($conn);
Question::init($conn);

try{
    UserTable::up();
    QuestionTable::up();

    // Execute the seeding process right after table creation
    seedQuestions();

    $result = User::create($name, $email, $password);
    $response = $result ? sendResponse(true, "User created!") : sendResponse(false, "Failed to create User");
}catch (\Throwable $e) {
    http_response_code(400);

    echo json_encode([
        "message" => $e->getMessage()
    ]);
}

// echo json_encode($response);
?>
