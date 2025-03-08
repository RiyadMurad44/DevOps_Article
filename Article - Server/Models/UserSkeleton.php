<?php

// require_once __DIR__ . '/../utils.php';

// class UserSkeleton {
//     protected static $conn;
//     protected static $table = "users";
//     private $id;
//     private $fullname;
//     private $email;
//     private $password;

//     // Set the connection (Must be called before using static functions)
//     public static function init($conn) {
//         self::$conn = $conn;
//     }

//     public static function init() {

//     }

//     public static function create($fullname, $email, $password) {
//         // Check if the user already exists
//         $checkSql = "SELECT COUNT(*) AS count FROM " . self::$table . " WHERE email = ?";
//         $stmt = self::$conn->prepare($checkSql);
//         $stmt->bind_param("s", $email);
//         $stmt->execute();
//         $result = $stmt->get_result()->fetch_assoc();
    
//         if ($result['count'] > 0) {
//             // User already exists, return false
//             return false;
//         }
    
//         // Hash the password before inserting
//         $hashedPassword = HashingPassword($password);
//         $sql = "INSERT INTO " . self::$table . " (fullname, email, password) VALUES (?, ?, ?)";
//         $stmt = self::$conn->prepare($sql);
//         return $stmt->execute([$fullname, $email, $hashedPassword]);
//     }
    

//     // Read user by ID
//     public static function getById($id) {
//         $sql = "SELECT * FROM " . self::$table . " WHERE id = ?";
//         $stmt = self::$conn->prepare($sql);
//         $stmt->execute([$id]);
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     // Read all users
//     public static function getAll() {
//         $sql = "SELECT * FROM " . self::$table;
//         $stmt = self::$conn->query($sql);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     // Update user details
//     public static function update($id, $fullname, $email, $password = null) {
//         if ($password) {
//             $hashedPassword = HashingPassword($password);
//             $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ?, password = ? WHERE id = ?";
//             $stmt = self::$conn->prepare($sql);
//             return $stmt->execute([$fullname, $email, $hashedPassword, $id]);
//         } else {
//             $sql = "UPDATE " . self::$table . " SET fullname = ?, email = ? WHERE id = ?";
//             $stmt = self::$conn->prepare($sql);
//             return $stmt->execute([$fullname, $email, $id]);
//         }
//     }

//     // Delete user
//     public static function delete($id) {
//         $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
//         $stmt = self::$conn->prepare($sql);
//         return $stmt->execute([$id]);
//     }
// }
?>


<?php

class UserSkeleton {
    protected static $conn;
    protected static $table = "users";

    private $id;
    private $fullname;
    private $email;
    private $password;

    public function __construct($id = null, $fullname = "", $email = "", $password = "") {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
    }

    public static function init($conn) {
        self::$conn = $conn;
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
}
?>