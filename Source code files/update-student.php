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
			$update = $conn->query("UPDATE student_info SET `first_name`='".$_POST['first_name']."',`midddle_name`='".$_POST['middle_name']."',`last_name`='".$_POST['last_name']."',`contact_number`=".$_POST['contact_num'].",`home_address`='".$_POST['home_add']."',`street_address`='".$_POST['street_add']."',`city_address`='".$_POST['city_add']."',`country_address`='".$_POST['country_add']."',`10th_marks`=".$_POST['10marks'].",`12th_marks`=".$_POST['12marks'].",`aadhar_no`=".$_POST['aadhar'].",`10th_board`='".$_POST['10board']."',`12th_board`='".$_POST['12board']."',`10th_yop`=".$_POST['10yop'].",`12th_yop`=".$_POST['12yop'].",`religion`='".$_POST['religion']."',`caste`='".$_POST['caste']."',`email_id`='".$_POST['email']."'WHERE mis=".$_POST['mis'].";");
			if($update === TRUE){
				echo "<script>alert('Student record updated successfully');</script>";
			}
			else{
				echo "<script>alert('Record not updated');</script>";
			}
			
		}
		else{
			$insert = $conn->query("INSERT INTO student_info VALUES('".$_POST['first_name']."','".$_POST['middle_name']."','".$_POST['last_name']."',".$_POST['contact_num'].",'".$_POST['home_add']."','".$_POST['street_add']."','".$_POST['city_add']."','".$_POST['country_add']."','".$_POST['10marks']."',".$_POST['12marks'].",".$_POST['aadhar'].",'".$_POST['10board']."','".$_POST['12board']."',".$_POST['10yop'].",".$_POST['12yop'].",'".$_POST['religion']."','".$_POST['caste']."',".$_POST['mis'].",'".$_POST['email']."');");
			if($insert === TRUE){
				echo "<script>alert('Student record added successfully');</script>";
			}
			else{
				echo "<script>alert('Record not added');</script>";
			}
		}
		$conn->close();
	}
	$_SESSION['MIS'] = $_POST['mis'];
	header("Location: dashboard.php");
}
?>