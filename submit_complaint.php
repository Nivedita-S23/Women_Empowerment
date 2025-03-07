<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $message = $conn->real_escape_string($_POST['message']);

    // Insert complaint into database
    $stmt = $conn->prepare("INSERT INTO complaints (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>