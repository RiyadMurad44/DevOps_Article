<?php
// Question.php

require_once "QuestionSkeleton.php";

class Question extends QuestionSkeleton {
    // Initialize database connection
    public static function init($conn) {
        parent::init($conn); // Initialize connection in parent class
    }

    // Create a new question
    public static function create($question, $answer) {
        $sql = "INSERT INTO " . self::$table . " (question, answer) VALUES (?, ?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("ss", $question, $answer);
        return $stmt->execute();
    }

    // Read question by ID
    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Read all questions
    public static function getAll() {
        $sql = "SELECT * FROM " . self::$table;
        $result = self::$conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update question details
    public static function update($id, $question, $answer) {
        $sql = "UPDATE " . self::$table . " SET question = ?, answer = ? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("ssi", $question, $answer, $id);
        return $stmt->execute();
    }

    // Delete question
    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>

