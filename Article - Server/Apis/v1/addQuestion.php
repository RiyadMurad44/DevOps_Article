<?php
require_once("../../utils.php");
require_once("../../Models/Question.php");
require_once("../../Connection/connection.php");
require_once("../../Database/Migrations/QuestionTable.php");

if(isset($data["question"]) && isset($data["answer"])) {
    $question = $data["question"];
    $answer = $data["answer"];
} else {
    sendResponse(false, "Missing parameters");
}

Question::init($conn);
// $questionModel = new Question();

try {
    $result = Question::create($question, $answer);
    // $result = $questionModel->create($question, $answer);
    $response = $result ? sendResponse(true, "Question created!") : sendResponse(false, "Failed to create question");
} catch (\Throwable $e) {
    http_response_code(400);

    echo json_encode([
        "message" => $e->getMessage()
    ]);
}
?>
