<?php
require_once("../../utils.php");
require_once("../../Models/Question.php");
require_once("../../Connection/connection.php");

try {
    $questions = Question::getAll();
    echo json_encode([
        "success" => true,
        "data" => $questions
    ]);
    exit();
} catch (\Throwable $e) {
    http_response_code(400);

    echo json_encode([
        "message" => $e->getMessage()
    ]);
}
?>
