<?php
require "UserSkeleton.php";

class User extends UserSkeleton {

    public static function init($conn) {
        parent::init($conn);
    }

    public static function create($fullname, $email, $password) {
        // Check if the user already exists
        $checkSql = "SELECT COUNT(*) AS count FROM " . self::$table . " WHERE email = ?";
        $stmt = self::$conn->prepare($checkSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result['count'] > 0) {
            return false;
        }

        // Hash password
        $hashedPassword = HashingPassword($password);

        // Insert new user
        $sql = "INSERT INTO " . self::$table . " (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("sss", $fullname, $email, $hashedPassword);
        return $stmt->execute();
    }

    // Read user by ID
    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Read all users
    public static function getAll() {
        $sql = "SELECT * FROM " . self::$table;
        $result = self::$conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update user details
    public static function update($id, $fullname, $email, $password = null) {
        if ($password) {
            $hashedPassword = HashingPassword($password) ?? password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ?, password = ? WHERE id = ?";
            $stmt = self::$conn->prepare($sql);
            $stmt->bind_param("sssi", $fullname, $email, $hashedPassword, $id);
        } else {
            $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ? WHERE id = ?";
            $stmt = self::$conn->prepare($sql);
            $stmt->bind_param("ssi", $fullname, $email, $id);
        }
        return $stmt->execute();
    }

    // Delete user
    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>
