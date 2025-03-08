<?php

require_once __DIR__ . '/../utils.php';

class UserSkeleton {
    protected static $conn;
    protected static $table = "users"; // Table name

    // Set the connection (Must be called before using static functions)
    public static function init($conn) {
        self::$conn = $conn;
    }

    // Create a new user
    public static function create($fullname, $email, $password) {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $hashedPassword = HashingPassword($password);
        $sql = "INSERT INTO " . self::$table . " (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([$fullname, $email, $hashedPassword]);
    }

    // Read user by ID
    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read all users
    public static function getAll() {
        $sql = "SELECT * FROM " . self::$table;
        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update user details
    public static function update($id, $fullname, $email, $password = null) {
        if ($password) {
            // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $hashedPassword = HashingPassword($password);
            $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ?, password = ? WHERE id = ?";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute([$fullname, $email, $hashedPassword, $id]);
        } else {
            $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ? WHERE id = ?";
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute([$fullname, $email, $id]);
        }
    }

    // Delete user
    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
