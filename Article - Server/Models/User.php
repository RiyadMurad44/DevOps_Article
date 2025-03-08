<?php
require "UserSkeleton.php";

class User extends UserSkeleton {
    // Initialize database connection
    public static function init($conn) {
        // global $conn; 
        parent::init($conn);
    }
}

?>
