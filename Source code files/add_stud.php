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
      <input type="text" name="mis" class="form-control" placeholder="Enter mis" pattern="^[1-9][0-9]{9}$">
	   <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
		<input type="text" name="last_name" class="form-control" placeholder="Enter last name">
		<input type="text" name="department_Id" class="form-control" placeholder="Enter department id">
		<input type="text" name="credit" class="form-control" placeholder="Enter credits">
		<input type="text" name="middle_name" class="form-control" placeholder="Enter middle name">
		<input type="text" name="year_of_joining" class="form-control" placeholder="Enter year of joining">
	 <input type="text" name="degree" class="form-control" placeholder="Enter degree">
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
	if(isset($_POST['mis']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['password']) || isset($_POST['department_Id']) || isset($_POST['credit']) || isset($_POST['middle_name']) || isset($_POST['year_of_joining']) || isset($_POST['degree'])){
		$conn = mysqli_connect('localhost','root','','test7');
		if($conn->connect_error){
			echo "$conn->connect_error";
			die("Connection Failed : ". $conn->connect_error);
		}
		else{
			$insert= $conn->query("INSERT INTO student VALUES(".$_POST['mis'].", '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['password']."', '".$_POST['department_Id']."', ".$_POST['credit'].", '".$_POST['middle_name']."', ".$_POST['year_of_joining'].", '".$_POST['degree']."');");
			if($insert=== TRUE){
				echo "<script>alert('Student record added successfully');</script>";
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
	header("Location: dashboard-teacher.php");
	}

	?>

