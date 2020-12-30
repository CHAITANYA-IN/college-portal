<?php
	$misinput = $_POST['inputmis'];
	$password = $_POST['inputPassword'];
	echo $misinput. " " . $password;

	// Database connection
	$conn = mysqli_connect('localhost','root','','test7');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else {
		$stmt = $conn->query("SELECT * from student WHERE mis=".$misinput." AND password='".$password."';");
		if(mysqli_num_rows($stmt)==1){
			$res = $stmt->fetch_assoc();
			echo $res['mis']." ".$res['password'];
			echo $res['mis']."Logged in successfully...";
			session_start();
			$_SESSION['MIS'] = $res['mis'];
			header("Location: dashboard.php");
		}
		else{
			echo "Login unsuccessful...";
			header("Location: student-signin.html");
			die();
		}
	}
		$stmt->close();
		$conn->close();
	
?>

