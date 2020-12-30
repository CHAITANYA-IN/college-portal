<?php
	$facinput = $_POST['inputfac_id'];
	$password = $_POST['inputPassword'];
	echo $facinput. " " . $password;

	// Database connection
	$conn = mysqli_connect('localhost','root','','test7');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else {
		$stmt = $conn->query("SELECT * from faculty WHERE faculty_id='".$facinput."' AND password='".$password."'");
		if(mysqli_num_rows($stmt)==1){
			$res = $stmt->fetch_assoc();
			echo $res['faculty_id']." ".$res['password'];
			echo $res['faculty_id']."Logged in successfully...";
			session_start();
			$_SESSION['FAC'] = $res['faculty_id'];
			header("Location: dashboard-teacher.php");
		}
		else{
			echo "Login unsuccessful...";
			header("Location: teacher-signin.html");
			die();
		}
	}
	$stmt->close();
	$conn->close();
?>

