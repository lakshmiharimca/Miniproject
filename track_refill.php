<?php
session_start();
include_once('../includes/db_con.php');

if (isset($_SESSION['cid'])) {

    $title = 'Track your refill';
    $cid = $_SESSION['cid'];

    $result = mysqli_query($conn, "SELECT name FROM consumer_detail WHERE cid=$cid") or die(mysqli_error($conn));
    $r = mysqli_fetch_row($result);

    $con_name = ' ' . $r[0];
    $path = 'design/';

    include_once('design/header.php');

    // Add active class for navigation bar
    echo "
	<script>
	$(document).ready(function(){
        $('#2').addClass('active');
	});
	</script>
	";

    // Fetch latest order details
    $result = mysqli_query($conn, "SELECT * FROM order_detail WHERE cid=$cid AND status!='Delivered' ORDER BY date DESC, time DESC") or die(mysqli_error($conn));

    if ($r = mysqli_fetch_array($result)) {
        echo '
		<div class="container">
			<br>
			<div class="panel panel-default">
				<div class="panel-heading"><h2>' . $title . '</h2></div>
				<div class="panel-body">
					<table class="table table-striped" style="font-size:95%">
						<thead>
							<tr>
								<th>Order Id</th>
								<th>Date of order place</th>
								<th>Time of order place</th>
								<th>Payable amount</th>
								<th>Order Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>' . $r['oid'] . '</td>
								<td>' . $r['date'] . '</td>
								<td>' . $r['time'] . '</td>
								<td>' . $r['amt'] . '</td>
								<td>' . $r['status'] . '</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		';
    } else {
        echo '<div class="container"><p>No order found.</p></div>';
    }

    include_once('design/footer.php');
} else {
    header('Location:../index.php');
}
?>
