<?php
require "UserSkeleton.php";

class User extends UserSkeleton {

    public static function create($fullname, $email, $password) {
        global $conn;
        $checkSql = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result['count'] > 0) {
            return false;
        }

        // Hash password
        $hashedPassword = HashingPassword($password);

        // Insert new user
        $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fullname, $email, $hashedPassword);
        return $stmt->execute();
    }

    public static function getById($id) {
        global $conn;
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Find user by email
    public static function findByEmail($email) {
        global $conn;
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Return user data if email exists
        } else {
            return null;  // Return null if user doesn't exist
        }
    }

    public static function getAll() {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = self::$conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function update($id, $fullname, $email, $password = null) {
        global $conn;
        if ($password) {
            $hashedPassword = HashingPassword($password);
            $sql = "UPDATE users SET fullname = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $fullname, $email, $hashedPassword, $id);
        } else {
            $sql = "UPDATE users SET fullname = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $fullname, $email, $id);
        }
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
