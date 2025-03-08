<?php

class QuestionTable {
    public static function up() {
        global $conn;

        // Check if the table exists using mysqli_num_rows
        $checkTable = $conn->query("SHOW TABLES LIKE 'questions'");
        if ($checkTable && mysqli_num_rows($checkTable) > 0) {
            echo "Table 'questions' already exists. Skipping creation.\n";
            return;
        }

        // If the table doesn't exist, create it using mysqli query
        $sql = "CREATE TABLE questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question TEXT NOT NULL,
            answer TEXT NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'questions' created successfully.\n";
        } else {
            echo "Error creating table: " . $conn->error . "\n";
        }
    }

    public static function down() {
        global $conn;
        $sql = "DROP TABLE IF EXISTS questions";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'questions' dropped successfully.\n";
        } else {
            echo "Error dropping table: " . $conn->error . "\n";
        }
    }
}
?>
