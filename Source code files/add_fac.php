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
      <input type="text" name="faculty_id" class="form-control" placeholder="Enter faculty ID">
	   <input type="text" name="faculty_name" class="form-control" placeholder="Enter faculty name">
		<input type="text" name="department_id" class="form-control" placeholder="Enter department name">
		<input type="text" name="salary" class="form-control" placeholder="Enter Salary">
		<input type="text" name="year_of_joining" class="form-control" placeholder="Enter year of joinig">
		<input type="text" name="contact_number" class="form-control" placeholder="Enter contact number">
		<input type="text" name="email_id" class="form-control" placeholder="Enter email id">
		<input type="password" name="password" class="form-control" placeholder="Enter password">
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>

<?php
	session_start();
	$faculty = $_SESSION['FAC'];
	if(isset($_POST['submit'])){
	if(isset($_POST['faculty_id']) || isset($_POST['faculty_name']) || isset($_POST['department_id']) || isset($_POST['salary']) || isset($_POST['year_of_joining']) || isset($_POST['contact_number']) || isset($_POST['email_id']) || isset($_POST['password'])){
		$conn = mysqli_connect('localhost','root','','test7');
		if($conn->connect_error){
			echo "$conn->connect_error";
			die("Connection Failed : ". $conn->connect_error);
		}
		else{
			$insert= $conn->query("INSERT INTO faculty VALUES('".$_POST['faculty_id']."', '".$_POST['faculty_name']."','".$_POST['department_id']."',".$_POST['salary'].", ".$_POST['year_of_joining'].", ".$_POST['contact_number'].", '".$_POST['email_id']."', '".$_POST['password']."');");
			if($insert=== TRUE){
				echo "<script>alert('Faculty record added successfully');</script>";
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
	$_SESSION['FAC'] = $faculty;
	header("Location: hod-dashboard.php");
	}

	?>