<!doctype html>
<html lang="en">

<head>
<title>
Your Dashboard
</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>
<?php 
	session_start();
	$_SESSION['hod'] = TRUE;
	if(!isset($_SESSION['FAC'])){
		session_destroy();
		header("Location: hod-signin.html");
	}
	$faculty = $_SESSION['FAC']; 
	$conn = mysqli_connect('localhost','root','','test7');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	}
	else {
		$dep = "";
		$stmt = $conn->query("SELECT t.course_no, c.course_name, c.type, t.year, t.sem_no FROM `teacher's_subject` as t, courses as c WHERE t.faculty_id ='".$faculty."' AND t.course_no=c.course_no;");
?>


	
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">University</a>
        <span class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 style="color:#fff;" align="center;">
                Dashboard
			</h1>
		</span>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="signout.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" id="flex">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#info" >
                                <span data-feather="info"></span>
                                Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#course">
                                <span data-feather="book-open"></span>
                                Courses
                            </a>
                        </li>
						<?php
						$_SESSION['FAC'] = $faculty;
						?>
						<li class="nav-item">
                            <a class="nav-link" href="add_course.php">
                                <span data-feather="plus"></span>
                                Add Course 
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="add_stud.php">
                                <span data-feather="plus"></span>
                                Add Student 
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="add_fac.php">
                                <span data-feather="plus"></span>
                                Add Faculty
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#del_course">
                                <span data-feather="plus"></span>
                                Delete Course 
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#del_stud">
                                <span data-feather="plus"></span>
                                Delete Student 
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#del_fac">
                                <span data-feather="plus"></span>
                                Delete Faculty
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#map">
                                <span data-feather="plus"></span>
                                New Course Registeration
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                
				
				<h2 id="course">Courses Taught</h2>
				<br>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Type</th>
                                <th>Year</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						if(mysqli_num_rows($stmt)>0){
							while($row = $stmt->fetch_assoc()){
								echo "<tr>";
								foreach($row as $i){
									echo "<td>$i</td>";
								}
								echo "</tr>";
							}
						}
					?>
                        </tbody>
                    </table>
                </div>
                
				<?php
				$stmt = $conn->query("SELECT * from faculty WHERE faculty_id='".$faculty."';");
				if(mysqli_num_rows($stmt)==1) {
					if($row = $stmt->fetch_assoc()){
						$dep=$row['department_id'];
?>
				<br><hr><br>
				<h2 id="info">Faculty Information <a href="update_teacher_profile.php" class="btn btn-info" style="float:right;">Edit Profile</a></h2>
				<br>
				  <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?php
						echo $row['faculty_name'];
				
						?>
                    </div>
                  </div>
                  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Faculty ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['faculty_id'];
				
						?>
                    </div>
					</div>
					<hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['email_id'];
				
						?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['contact_number'];
				
						?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Salary</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					
					  	<?php
						echo $row['salary'];
				
						?>
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Year of Joining</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?php
						echo $row['year_of_joining'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Department</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['department_id'];
				
						?>
                    </div>
                  </div>
                </div>
              </div>
			  <?php
					}
				}
			  ?>
			  <br><hr><br>
			  <div id="map">
			  <form class="form-horizontal" action="teacher-course-mapping.php" method="post">
			  <fieldset class="fieldset">
				<h2 class="fieldset-title">Course Mapping</h2>
				<div class="form-group">
					<label class="col-md-2  col-sm-3 col-xs-12 control-label">Course Name</label>
					<div class="col-md-10 col-sm-9 col-xs-12">
					<?php
						$query = $conn->query("SELECT course_no, course_name FROM courses;"); // Run your query
					?>
						<select name="course_selection" class="form-control"> <?php
						// Loop through the query results, outputing the options one by one
						while ($row = $query->fetch_assoc()) {
						   echo '<option value="'.$row['course_no'].'">'.$row['course_name'].'</option>';
						}?> </select>
					
						<p class="help-block">Select a course to teach</p>
					</div>
				</div>
				<?php 
					echo "<input type='hidden' name='faculty_id' value='".$faculty."'/>"; 
				?>
				<div class="form-group">
					<label class="col-md-2  col-sm-3 col-xs-12 control-label">Year</label>
					<div class="col-md-10 col-sm-9 col-xs-12">
						<input type="text" name="year" class="form-control" value="year" pattern="^[0-9]{4}$">
						<p class="help-block">Enter a year</p>
					</div>
				</div>
			<div class="form-group">
					<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
						<input class="btn btn-primary" type="submit" value="Add">
					</div>
			</div>
			</fieldset>
			  </form>
			  </div>
			  <br><hr><br>
			  <div id="del_course">
			  <form class="form-horizontal" action="del_course.php" method="post">
			  <fieldset class="fieldset">
			  	<h2 class="fieldset-title">Delete Course</h2>
				<div class="form-group">
					<label class="col-md-2  col-sm-3 col-xs-12 control-label">Course Number</label>
					<div class="col-md-10 col-sm-9 col-xs-12">
					<?php
						$query = $conn->query("SELECT course_no, course_name FROM courses WHERE department_id='".$dep."';"); // Run your query
					?>
					<select name="course_no" class="form-control"> <?php
						// Loop through the query results, outputing the options one by one
						while ($row = $query->fetch_assoc()) {
						   echo '<option value="'.$row['course_no'].'">'.$row['course_name'].'</option>';
						}?> </select>
					
						<p class="help-block">Select a course to delete</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
						<input class="btn btn-danger" type="submit" value="Delete">
					</div>
			</div>
				</fieldset>
				</form>
				</div>
				<br><hr><br>
				<div id="del_fac">
			  <form class="form-horizontal" action="del_fac.php" method="post">
			  <fieldset class="fieldset">
			  	<h2 class="fieldset-title">Delete Faculty</h2>
				<div class="form-group">
					<label class="col-md-2  col-sm-3 col-xs-12 control-label">Faculty ID</label>
					<div class="col-md-10 col-sm-9 col-xs-12">
					<?php
						$query = $conn->query("SELECT faculty_id, faculty_name FROM faculty WHERE department_id='".$dep."' AND faculty_id!='".$faculty."';"); // Run your query
					?>
					<select name="faculty_id" class="form-control"> <?php
						// Loop through the query results, outputing the options one by one
						while ($row = $query->fetch_assoc()) {
						   echo '<option value="'.$row['faculty_id'].'">'.$row['faculty_name'].'</option>';
						}?> </select>
					
						<p class="help-block">Select a faculty to delete</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
						<input class="btn btn-danger" type="submit" value="Delete">
					</div>
			</div>
				</fieldset>
				</form>
				</div>
				<br><hr><br>
				<div id="del_stud">
			  <form class="form-horizontal" action="del_stud.php" method="post">
			  <fieldset class="fieldset">
			  	<h2 class="fieldset-title">Delete Student</h2>
				<div class="form-group">
					<label class="col-md-2  col-sm-3 col-xs-12 control-label">Student MIS ID</label>
					<div class="col-md-10 col-sm-9 col-xs-12">
					<?php
						$query = $conn->query("SELECT mis, first_name, middle_name, last_name FROM student where department_Id='".$dep."';"); // Run your query
					?>
					<select name="mis" class="form-control"> <?php
						// Loop through the query results, outputing the options one by one
						while ($row = $query->fetch_assoc()) {
						   echo '<option value="'.$row['mis'].'">'.$row['first_name']." ".$row['middle_name']." ".$row['last_name'].'</option>';
						}?> </select>
					
						<p class="help-block">Select a student to delete</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
						<input class="btn btn-danger" type="submit" value="Delete">
					</div>
			</div>
				</fieldset>
				</form>
				</div>
				<br><hr><br>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
	<script>
		// Get the container element
		var btnContainer = document.getElementById("flex");

		// Get all buttons with class="btn" inside the container
		var options = btnContainer.getElementsByClassName("nav-link");

		// Loop through the buttons and add the active class to the current/clicked button
		for (var i = 0; i < options.length; i++) {
		  options[i].addEventListener("click", function() {
			var current = document.getElementsByClassName("active");
			current[0].className = current[0].className.replace(" active", "");
			this.className += " active";
		  });
		} 
	</script>
<?php
	}
	$conn->close();
?>
</body>

</html>