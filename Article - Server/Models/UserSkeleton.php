<?php

abstract class UserSkeleton {

    protected $id;
    protected $fullname;
    protected $email;
    protected $password;

    public function __construct($id = null, $fullname = "", $email = "", $password = "") {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Abstract CRUD methods to enforce implementation in child classes
    abstract public static function create($fullname, $email, $password);
    abstract public static function getById($id);
    abstract public static function findByEmail($email);
    abstract public static function getAll();
    abstract public static function update($id, $fullname, $email, $password);
    abstract public static function delete($id);
}
?>
