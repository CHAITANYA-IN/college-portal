<?php
	$hod_input = $_POST['inputfac_id'];
	$password = $_POST['inputPassword'];
	echo $hod_input. " " . $password;

	// Database connection
	$conn = mysqli_connect('localhost','root','','test7');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else {
		$stmt = $conn->query("SELECT * from faculty as f, department as d WHERE f.faculty_id='".$hod_input."' AND f.password='".$password."' AND f.department_id=d.department_id AND f.faculty_id=d.hod;");
		if(mysqli_num_rows($stmt)==1){
			$res = $stmt->fetch_assoc();
			echo $res['faculty_id']." ".$res['password'];
			echo $res['faculty_id']."Logged in successfully...";
			session_start();
			$_SESSION['FAC'] = $res['faculty_id'];
			header("Location: hod-dashboard.php");
		}
		else{
			echo "Login unsuccessful...";
			header("Location: hod-signin.html");
			die();
		}
	}
	$stmt->close();
	$conn->close();
?>