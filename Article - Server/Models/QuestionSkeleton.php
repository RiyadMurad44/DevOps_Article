<?php
// QuestionSkeleton.php

class QuestionSkeleton {
    protected static $conn;
    protected static $table = "questions";

    private $id;
    private $question;
    private $answer;

    // Constructor
    public function __construct($id = null, $question = "", $answer = "") {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    // Initialize a new question instance with the database connection
    public static function init($conn) {
        self::$conn = $conn;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }
}
?>

