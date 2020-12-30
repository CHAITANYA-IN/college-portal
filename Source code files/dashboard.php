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
	if(!isset($_SESSION['MIS'])){
		session_destroy();
		header("Location: student-signin.html");
	}
	$mis = $_SESSION['MIS']; 
	$conn = mysqli_connect('localhost','root','','test7');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else {
		
		$stmt = $conn->query("SELECT s.course_no,c.course_name,c.type,s.sem_no,s.attempt_no,grades.pointer,s.status from courses as c,`sem-n_details` as s, grades where s.mis=".$mis." AND c.course_no=s.course_no AND s.grade=grades.grade;");
		$result = $conn->query("SELECT a.sem_no, sum(c.credit),a.cgpa, a.sgpa, a.status FROM academics as a, courses as c, `sem-n_details` as s WHERE a.mis=1118031013 AND a.mis=".$mis." AND s.course_no=c.course_no AND s.status='pass' GROUP BY a.sem_no;");
		$graph = $conn->query("SELECT sem_no, cgpa FROM academics WHERE mis=".$mis." ORDER BY sem_no;");
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
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h1 id="report">Overall Report</h2>
				<hr><br>

                <h2 id="course">Course Performance</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Type</th>
                                <th>Semester</th>
                                <th>Attempts</th>
                                <th>Pointer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						if(mysqli_num_rows($stmt)>0) {
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
				$_SESSION['MIS'] = $mis;
				?>
				<br><hr><br>
				<h2 id="info">Student Information <a href="update_student_profile.php" class="btn btn-primary" style="float:right;" >Edit Profile</a></h2>
				<?php
				$stmt = $conn->query("SELECT * FROM student_info WHERE mis=".$mis.";");
				if(mysqli_num_rows($stmt)==1) {
					if($row = $stmt->fetch_assoc()){		
?>
				  <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?php
						echo $row['first_name']." ".$row['midddle_name']." ".$row['last_name'];
				
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
                      <h6 class="mb-0">10th Result</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					
					  	<?php
						echo $row['10th_marks'];
				
						?>
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?php
						echo $row['home_address']." ".$row['street_address']." ".$row['city_address']. " ".$row['country_address'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">12th-marks</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['12th_marks'];
				
						?>
                    </div>
                  </div>
                  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Aaadhar-Card</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['aadhar_no'];
				
						?>
						
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">10-Board</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['10th_board'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">12th-Board</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['12th_board'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">10th-Year of Passing</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['10th_yop'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">12th-Year of Passing</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['12th_yop'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Religion</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['religion'];
				
						?>
                    </div>
                  </div>
				  <hr>
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Caste</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php
						echo $row['caste'];
				
						?>
                    </div>
                  </div>
                  </div>
                </div>
				<?php
					}
					
				}
				else{
			  ?>
			  <h6 align="center">Information not yet added</h6>
			  <?php
				}
			  ?>
              </div>
			  
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