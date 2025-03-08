<?php
require_once("../../Models/Question.php");
require_once("../../Connection/connection.php");

function seedQuestions() {
    Question::init($GLOBALS['conn']);

    $sampleQuestions = [
        ["What is the capital of France?", "Paris"],
        ["Who wrote 'To Kill a Mockingbird'?", "Harper Lee"]
    ];

    foreach ($sampleQuestions as $q) {
        try {
            $question = $q[0];
            $answer = $q[1];

            // Check if the question already exists
            $checkSql = "SELECT COUNT(*) AS count FROM questions WHERE question = ?";
            $stmt = $GLOBALS['conn']->prepare($checkSql);
            $stmt->bind_param("s", $question);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            if ($result['count'] > 0) {
                echo "Skipped (already exists): $question\n";
                continue;
            }

            // Insert new question
            $inserted = Question::create($question, $answer);

            if ($inserted) {
                echo "Inserted: $question - $answer\n";
            } else {
                echo "Failed to insert: $question\n";
            }
        } catch (\Throwable $e) {
            echo "Error inserting data: " . $e->getMessage() . "\n";
        }
    }
}
?>
