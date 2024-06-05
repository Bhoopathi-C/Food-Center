<?php
include 'db_connection.php'; // Include the database connection

// Assuming you get these values from a form or other source
$user_id = 1; // Replace with dynamic user ID
$amount = 100.00;
$transaction_id = 'ABC123';
$payment_status = 'pending';

// Insert payment record
$sql = "INSERT INTO Payment (user_id, amount, transaction_id, payment_status)
VALUES ('$user_id', '$amount', '$transaction_id', '$payment_status')";

if ($conn->query($sql) === TRUE) {
    echo "New payment record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
