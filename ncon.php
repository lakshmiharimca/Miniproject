
<?php
session_start();
include_once('../includes/db_con.php');
include_once('design/header.php');
if(isset($_SESSION['cid']))
{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        
        // Sanitize and validate the input data (you may need to customize this based on your requirements)
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $m_no = mysqli_real_escape_string($conn, $_POST['m_no']);
        $e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
        $pwd = password_hash(mysqli_real_escape_string($conn, $_POST['pwd']), PASSWORD_DEFAULT); // Hash the password
        
        // Insert the new customer into the database
        $insert_query = "INSERT INTO consumer_detail (name, address, city, pin, m_no, e_id, pwd) 
                         VALUES ('$name', '$address', '$city', '$pincode', '$m_no', '$e_id', '$pwd')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Redirect to the customer profile page or any other page as needed
            header('Location: c_prof.php');
            exit();
        } else {
            // Handle the case where the insertion failed
            echo "Error: " . mysqli_error($conn);
        }
    }
    
    $title = 'Add Customer';
    
    // Include header
    include_once('design/header.php');
    
    // Display the form for adding a new customer
   
    
    // Include footer
    include_once('design/footer.php');
}
else
{
    header('Location:../index.php');
}
?>
