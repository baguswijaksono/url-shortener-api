<?php
$dbConfig = array(
    "servername" => "localhost",
    "username" => "",
    "password" => "",
    "dbname" => ""
);

$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(array("error" => "Connection failed: " . $conn->connect_error));
    exit();
}


?>
