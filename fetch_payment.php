<?php
include 'db_connection.php'; // Include the database connection

$user_id = 1; // Replace with dynamic user ID

// Fetch payment records
$sql = "SELECT * FROM Payment WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Payment ID: " . $row["payment_id"]. " - Amount: " . $row["amount"]. " - Status: " . $row["payment_status"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
