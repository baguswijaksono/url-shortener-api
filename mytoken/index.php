<?php

require_once('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare an SQL statement to fetch user data based on the provided username
    $stmt = $conn->prepare("SELECT password, token FROM users WHERE username = ?");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the provided password with the hashed password from the database
        if (password_verify($password, $hashedPassword)) {
            $userToken = $row['token'];

            http_response_code(200);
            $response = array("user_token" => $userToken);
            echo json_encode($response);
        } else {
            http_response_code(401); // Unauthorized
            $response = array("error" => "Invalid username or password");
            echo json_encode($response);
        }
    } else {
        http_response_code(404); // Not Found
        $response = array("error" => "User not found");
        echo json_encode($response);
    }
} else {
    http_response_code(405); // Method Not Allowed
    $response = array("error" => "Method not allowed");
    echo json_encode($response);
}
?>
