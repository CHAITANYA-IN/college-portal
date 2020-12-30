<?php
	session_start();
	echo $_POST['course_selection'].$_POST['faculty_id'].$_POST['year'];
	if(!isset($_POST['course_selection']) || !isset($_POST['faculty_id']) || ! isset($_POST['year'])){
		session_destroy();
	} 
	else{
		$conn = mysqli_connect('localhost','root','','test7');
		if($conn->connect_error){
			echo "$conn->connect_error";
			die("Connection Failed : ". $conn->connect_error);
		}
		
		else {
			if(isset($_POST['course_selection']) && isset($_POST['year'])){
				$result = $conn->query("SELECT sem_no FROM semester WHERE course_no='".$_POST['course_selection']."';");
				if($row=$result->fetch_assoc()){
					$insert = $conn->query("INSERT INTO `teacher's_subject` VALUES('".$_POST['faculty_id']."', '".$_POST['course_selection']."', ".$row['sem_no'].", ".$_POST['year'].");");
					if($insert=== TRUE){
					 echo "<script>alert('Course added successfully');</script>";
					}
					else{
						echo "<script>alert('Course not added or already exists');</script>";
					}
				}
				else{
					echo "<script>alert('Sem not added');</script>";
				}
			}
			$conn->close();
		}
	}
	session_start();
	$_SESSION['FAC'] = $_POST['faculty_id'];
	if($_SESSION['hod']){
		header('Location: hod-dashboard.php');
	}
	else{
	header("Location: dashboard-teacher.php");
	}

?>			