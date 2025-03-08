<?php

class UserTable {
    public static function up() {
        global $conn;

        // Check if the table exists using mysqli_num_rows
        $checkTable = $conn->query("SHOW TABLES LIKE 'users'");
        if ($checkTable && mysqli_num_rows($checkTable) > 0) {
            echo "Table 'users' already exists. Skipping creation.\n";
            return;
        }

        // If the table doesn't exist, create it using mysqli query
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password TEXT NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'users' created successfully.\n";
        } else {
            echo "Error creating table: " . $conn->error . "\n";
        }
    }

    public static function down() {
        global $conn;
        $sql = "DROP TABLE IF EXISTS users";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'users' dropped successfully.\n";
        } else {
            echo "Error dropping table: " . $conn->error . "\n";
        }
    }
}

?>
