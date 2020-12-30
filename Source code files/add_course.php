<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin</title>



    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="#" method="post">
         <svg width="80px" height="80px" viewBox="0 0 16 16" class="bi bi-file-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
	<path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
	</svg>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
     <!-- <label for="inputEmail" class="sr-only">Email MIS</label> -->
      <input type="text" name="course_no" class="form-control" placeholder="Enter Course Number">
	   <input type="text" name="course_name" class="form-control" placeholder="Enter Course Name">
		<input type="text" name="credit" class="form-control" placeholder="Enter Credits for the course">
		<input type="text" name="department_id" class="form-control" placeholder="Enter the department ID">
		<input type="text" name="sem_no" class="form-control" placeholder="Enter the semester number">
		<input type="text" name="type" class="form-control" placeholder="Enter Course type"><br>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>
<?php
	session_start();
	$faculty = $_SESSION['FAC'];
	if(isset($_POST['submit'])){
	if(isset($_POST['course_no']) && isset($_POST['course_name']) && isset($_POST['credit']) && isset($_POST['sem_no']) && isset($_POST['department_id']) && isset($_POST['type'])){
		$conn = mysqli_connect('localhost','root','','test7');
		if($conn->connect_error){
			echo "$conn->connect_error";
			die("Connection Failed : ". $conn->connect_error);
		}
		else{
			$insert= $conn->query("INSERT INTO courses VALUES('".$_POST['course_no']."', '".$_POST['course_name']."', ".$_POST['credit'].", '".$_POST['department_id']."', '".$_POST['type']."');");
			$sem = $conn->query("INSERT INTO semester VALUES(".$_POST['sem_no'].", '".$_POST['course_no']."');");
			if($insert=== TRUE && $sem === TRUE){
				echo "<script>alert('Course record added successfully');</script>";
			}
			else{
				echo "<script>alert('Record not added or already exists');</script>";
			}
		}
		$conn->close();
	}
	else{
		echo "<script>alert('Invalid Inputs');</script>";
	}
	session_start();
	$_SESSION['FAC'] = $faculty;
	header("Location: hod-dashboard.php");
	}

?>