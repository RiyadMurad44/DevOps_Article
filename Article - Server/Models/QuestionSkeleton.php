<?php
// QuestionSkeleton.php

abstract class QuestionSkeleton {
    
    protected $id;
    protected $question;
    protected $answer;

    // Constructor
    public function __construct($id = null, $question = "", $answer = "") {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
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

    // Abstract methods to be implemented in the child class
    abstract public static function create($question, $answer);
    abstract public static function getById($id);
    abstract public static function getAll();
    abstract public static function update($id, $question, $answer);
    abstract public static function delete($id);
}
?>


