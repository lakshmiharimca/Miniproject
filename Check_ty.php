<?php
session_start();
include_once('../../includes/db_con.php'); // Adjust the path as needed

if (isset($_SESSION['did'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newCylinderPrice = mysqli_real_escape_string($conn, $_POST['new_cylinder_price']);

        // Update the cylinder price in the database
        $updateResult = mysqli_query($conn, "UPDATE your_table_name SET cylinder_price='$newCylinderPrice' WHERE did=$did");

        if ($updateResult) {
            echo "Cylinder price updated successfully!";
        } else {
            echo "Failed to update cylinder price. Please try again.";
        }
    } else {
        echo "Invalid request method.";
    }
} else {
    echo "Session not found. Please log in.";
}
?>
