<?php
// Question.php

require "QuestionSkeleton.php";

class Question extends QuestionSkeleton {

    // Create a new question
    public static function create($question, $answer) {
        global $conn;
        $sql = "INSERT INTO questions (question, answer) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $question, $answer);
        return $stmt->execute();
    }

    // Read question by ID
    public static function getById($id) {
        global $conn;
        $sql = "SELECT * FROM questions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Read all questions
    public static function getAll() {
        global $conn;
        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update question details
    public static function update($id, $question, $answer) {
        global $conn;
        $sql = "UPDATE questions SET question = ?, answer = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $question, $answer, $id);
        return $stmt->execute();
    }

    // Delete question
    public static function delete($id) {
        global $conn;        
        $sql = "DELETE FROM questions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>

