<?php
//New distributor registration
include("header.php");
include_once('includes/db_con.php');		
if(isset($_REQUEST['dname']))
{
	//print_r($_FILES['id_img']);
	$dname = $_REQUEST['dname'];
	$dadd = $_REQUEST['dadd'];
	$dcity = $_REQUEST['dcity'];
	$dpin = $_REQUEST['dpin'];
	$demail = $_REQUEST['demail'];
	$dmno = $_REQUEST['dmno'];
	$dcpass = $_REQUEST['dcpass'];
	

	$result=mysqli_query($conn,'select * from distributor_detail where m_no='.$dmno.' or e_id="'.$demail.'"') or die(mysqli_error($conn));
	
	if (mysqli_num_rows($result) > 0)
	{
		echo 'Given mobile no. or email is already registered.';
	}
	
		else 
		{			
			// For data insert
			$q = "INSERT INTO `distributor_detail`(`pwd`, `name`, `address`, `city`, `pin`, `m_no`, `e_id`) 
					VALUES ('$dcpass', '$dname', '$dadd', '$dcity', $dpin, $dmno, '$demail');";
			mysqli_query($conn,$q) or die(mysqli_error($conn));
			
			$result=mysqli_query($conn,"select did from distributor_detail where m_no=$dmno") or die(mysqli_error($conn));
			$r=mysqli_fetch_row($result);
			
			//move file to desired location
			
			
			// For send back distibutor id 
			$q = "SELECT `did` FROM `distributor_detail` WHERE m_no=$dmno";
			$result=mysqli_query($conn,$q) or die(mysqli_error($conn));
			$r=mysqli_fetch_row($result);
			
			echo "<script>
			alert('Your Distibutor ID is $r[0], It will be used for system log-in.');
			</script>";
			
			echo '<p id=dmsgg >True</p>';
		}
	}	


?>