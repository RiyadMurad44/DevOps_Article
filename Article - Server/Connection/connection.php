<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Handle preflight requests (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit();
}

// Database configuration
$host = "localhost"; 
$username = "root"; 
$password = "SEf123456";
// $password = "";
$database = "devops_article"; 

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$data = [];
// check if request is JSON or formdata before pass body to any api
if ($_SERVER['REQUEST_METHOD'] === "GET" || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = $_GET;
  } else {
    if (isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] !== "application/json") {
  
      $data = $_POST;
    } else {
      $data = json_decode(file_get_contents("php://input"), true) ?? [];
    }
  }

?>