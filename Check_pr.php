<?php
session_start();
include_once('../includes/db_con.php');

if (isset($_SESSION['did'])) {
    $title = 'Update Cylinder Price';
    $did = $_SESSION['did'];

    // Fetch current distributor details
    $result = mysqli_query($conn, "SELECT * FROM distributor_detail WHERE did=$did") or die(mysqli_error($conn));
    $r = mysqli_fetch_array($result);

    $path = 'design/';

    include_once('design/header2.php');

    echo '
    <style>
        /* Add your styling for the update cylinder price form */
    </style>

    <div class="container">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading"><h2>' . $title . '</h2></div>
            <div class="panel-body">
                <form method="post" action="code/update_cylinder_price_process.php">
                    <div class="form-group">
                        <label for="new_cylinder_price"><b>New Cylinder Price *</b></label>
                        <input type="text" class="form-control" id="new_cylinder_price" name="new_cylinder_price" required>
                    </div>
                    <button type="submit" class="btn btn-info">Update Cylinder Price</button>
                </form>
            </div>
        </div>
    </div>';

    include_once('design/footer.php');
} else {
    header('Location:../index.php');
}
?>
