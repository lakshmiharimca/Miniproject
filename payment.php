<?php
session_start();
include_once('../includes/db_con.php');

if(isset($_SESSION['cid']))
{
	
	$title='Book Order';
	$cid=$_SESSION['cid'];
	
	$result=mysqli_query($conn,"select name from consumer_detail where cid=$cid");
	$r=mysqli_fetch_row($result);
	
	$con_name=' '.$r[0];
	$path='design/';
	
	include_once('design/header.php');
    $amount = $_POST['amount'];
    // Insert payment details into the database
$insert_query = "INSERT INTO payments (amount) VALUES ('$amount')";
mysqli_query($conn, $insert_query);

// Get the last inserted ID
$payment_id = mysqli_insert_id($conn);

// Dummy payment processing logic (replace with real payment gateway integration)
$transaction_id = 'TRX_' . uniqid();

// Update payment status and transaction ID
$update_query = "UPDATE payments SET status = 'Completed', transaction_id = '$transaction_id' WHERE id = $payment_id";
mysqli_query($conn, $update_query);
echo "<script>alert('Payment Sucessfull');window.location.href = 'book_ord.php';</script>";
// Close the database connection
mysqli_close($conn);
}
?>
    