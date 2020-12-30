 <?php
	session_start();
	$faculty = $_SESSION['FAC'];
 
$conn = mysqli_connect('localhost','root','','test7');
if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
}
else{
	$del= $conn->query("DELETE FROM faculty WHERE faculty_id='".$_POST['faculty_id']."';");

	if ($del === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

	$conn->close();
}
	$_SESSION['FAC'] = $faculty;
	header("Location: hod-dashboard.php");
?> 