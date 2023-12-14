<?php

require_once('db.php');

if (isset($_GET['short_url'])) {
    $short_url = $_GET['short_url'];

    // Prepare an SQL statement to retrieve the original URL
    $stmt = $conn->prepare("SELECT orurl FROM urls WHERE shurl = ?");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("s", $short_url);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_url = $row['orurl'];
        // Redirect to the original URL
        header("Location: $original_url");
        exit();
    } else {
        http_response_code(404); // Not Found
        $response = array("error" => "Short URL not found");
        echo json_encode($response);
    }
} else {
    http_response_code(400);
    $response = array("error" => "Short URL not provided");
    echo json_encode($response);
}
?>
