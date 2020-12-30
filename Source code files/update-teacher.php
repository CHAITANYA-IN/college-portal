<?php
session_start();
if(isset($_POST['submit'])){
$conn = mysqli_connect('localhost','root','','test7');
if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
}
else {
		if($_POST['bool']){
			$update = $conn->query("UPDATE faculty SET `faculty_name`='".$_POST['fac_name']."',`department_id`='".$_POST['facdept_id']."',`salary`=".$_POST['salary'].",`year_of_joining`=".$_POST['yoj'].",`contact_number`=".$_POST['contact_num'].",`email_id`='".$_POST['email']."',`password`='".$_POST['password']."' WHERE faculty_id='".$_POST['fac_id']."';");
			if($update === TRUE){
				echo "<script>alert('Student record updated successfully');</script>";
			}
			else{
				echo "<script>alert('Record not updated');</script>";
			}
			
		}
		else{
			echo "<script>alert('Record not updated');</script>";
		}
		$conn->close();
	}
	$_SESSION['FAC'] = $_POST['fac_id'];
	if($_POST['hod']){
		header("Location: hod-dashboard.php");
	}
	else{
		header("Location: dashboard-teacher.php");
	}
}
?>