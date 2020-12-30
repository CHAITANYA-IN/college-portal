<?php
session_start();
if(isset($_POST['submit'])){
$conn = mysqli_connect('localhost','root','','test7');
if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
}
else {
	$result = $conn->query("SELECT * FROM grades WHERE pointer=".$_POST['pointer'].";");
	$row = $result->fetch_assoc();
	echo $_POST['year']." ".$_POST['course_no']." ".$_POST['mis'];
	$result = $conn->query("SELECT * FROM `sem-n_details` WHERE mis=".$_POST['mis']." AND year=".$_POST['year']." AND course_no='".$_POST['course_no']."';");
		if(mysqli_num_rows($result) > 0){
			$update = $conn->query("UPDATE `sem-n_details` SET grade='".$row['grade']."', sem_no=".$_POST['sem_no'].",status='".$_POST['status']."',attempt_no=".$_POST['attempt_no']." WHERE mis=".$_POST['mis']." AND year=".$_POST['year']." AND course_no='".$_POST['course_no']."';");
			if($update === TRUE){
				echo "<script>alert('Student course record updated successfully');</script>";
			}
			else{
				echo "<script>alert('Record not updated');</script>";
			}
			
		}
		else{
			$insert = $conn->query("INSERT INTO `sem-n_details` VALUES('".$_POST['course_no']."', ".$_POST['sem_no'].",'".$row['grade']."','".$_POST['status']."',".$_POST['mis'].",".$_POST['year'].",".$_POST['attempt_no'].");");
			if($insert === TRUE){
				echo "<script>alert('Student record added successfully');</script>";
			}
			else{
				echo "<script>alert('Record not added');</script>";
			}
		}
		$conn->close();
	}
	$_SESSION['FAC'] = $_SESSION['FAC'];
	header("Location: dashboard-teacher.php");
}

/* $row = $conn->query(SELECT AVG(g.pointer) as sgpa FROM grades as g, `sem-n_details` as s where g.grade=s.grade AND s.status="pass" GROUP BY s.sem_no)->fetch_assoc();
INSERT INTO academic(sem_no, sgpa, year, mis) VALUES($_POST['sem_no'], $row['sgpa'], $_POST['year'], $_POST['mis']);
UPDATE academic SET cgpa=AVG(sgpa) GROUP BY mis;
while($row = $conn->query(SELECT status FROM `sem-n_details` WHERE mis= $_POST['mis'] AND sem_no = $_POST['sem_no'])->fetch_assoc){
	if($row['status'] != "pass"){
		UPDATE academic SET status="fail" WHERE mis= $_POST['mis'] AND sem_no = $_POST['sem_no'];
	}
}
UPDATE academic SET status="pass" WHERE mis= $_POST['mis'] AND sem_no = $_POST['sem_no'];
*/
?>
