<!DOCTYPE html>
<html lang="en">
<head>
<title>
Our courses 
</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="navbar.css" />
<style>
	.thead-dark {
		background-color: #000;
		color: #fff;
	}
</style>
</head>
<body>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
<a class="navbar-brand" href="home-page.php">University</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06"
aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarsExample06">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a class="nav-link" href="home-page.php">Home <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="department-display.php">Departments</a>
</li>
<li class="nav-item">
<a class="nav-link active" href="#">Courses</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown06" data-toggle="dropdown"
aria-haspopup="true" aria-expanded="false">People</a>
<div class="dropdown-menu" aria-labelledby="dropdown06">
<a class="dropdown-item" href="student-signin.html">Student</a>
<a class="dropdown-item" href="teacher-signin.html">Faculty</a>
<a class="dropdown-item" href="hod-signin.html">HOD</a>
</div>
</li>
</ul>

</div>
</nav>
<?php
$conn = mysqli_connect('localhost','root','','test7');
$query = "SELECT * FROM courses";

echo '<table class="table">
  <thead class="thead-dark">
    <tr>
		<td> <font face="Arial">Course-Number</font> </td> 
        <td> <font face="Arial">Course-Name</font> </td> 
        <td> <font face="Arial">Credits</font> </td>
		<td> <font face="Arial">Department-ID</font> </td>
		<td> <font face="Arial">Type</font> </td>
    </tr>
  </thead>
  <tbody>';

$result = $conn->query("SELECT * FROM courses");
if (mysqli_num_rows($result)>0) {
    while($row = $result->fetch_assoc()) {
        $field1name = $row["course_no"];
        $field2name = $row["course_name"];
        $field3name = $row["credit"];
		$field4name = $row["department_id"];
		$field5name = $row["type"];

        echo '<tr> 
                  <th scope="row">'.$field1name.'</th> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
				  <td>'.$field4name.'</th> 
                  <td>'.$field5name.'</td> 
              
              </tr>';
    }
    $result->free();
} 
?>
</tbody>
</table>
</body>
</html>