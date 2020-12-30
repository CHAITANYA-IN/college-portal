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
	$stmt = $conn->query("SELECT * FROM student_info WHERE mis=".$mis.";");
	$info = $conn->query("SELECT first_name, middle_name, last_name FROM student WHERE mis=".$mis.";");
	$info = $info->fetch_assoc();
	$bool = mysqli_num_rows($stmt) == 1;
	$row = $stmt->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Update user profile - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
background:#f9f9fb;    
}
.view-account{
background:#FFFFFF; 
margin-top:20px;
}
.view-account .pro-label {
font-size: 13px;
padding: 4px 5px;
position: relative;
top: -5px;
margin-left: 10px;
display: inline-block
}

.view-account .side-bar {
padding-bottom: 30px
}

.view-account .side-bar .user-info {
text-align: center;
margin-bottom: 15px;
padding: 30px;
color: #616670;
border-bottom: 1px solid #f3f3f3
}

.view-account .side-bar .user-info .img-profile {
width: 120px;
height: 120px;
margin-bottom: 15px
}

.view-account .side-bar .user-info .meta li {
margin-bottom: 10px
}

.view-account .side-bar .user-info .meta li span {
display: inline-block;
width: 100px;
margin-right: 5px;
text-align: right
}

.view-account .side-bar .user-info .meta li a {
color: #616670
}

.view-account .side-bar .user-info .meta li.activity {
color: #a2a6af
}

.view-account .side-bar .side-menu {
text-align: center
}

.view-account .side-bar .side-menu .nav {
display: inline-block;
margin: 0 auto
}

.view-account .side-bar .side-menu .nav>li {
font-size: 14px;
margin-bottom: 0;
border-bottom: none;
display: inline-block;
float: left;
margin-right: 15px;
margin-bottom: 15px
}

.view-account .side-bar .side-menu .nav>li:last-child {
margin-right: 0
}

.view-account .side-bar .side-menu .nav>li>a {
display: inline-block;
color: #9499a3;
padding: 5px;
border-bottom: 2px solid transparent
}

.view-account .side-bar .side-menu .nav>li>a:hover {
color: #616670;
background: none
}

.view-account .side-bar .side-menu .nav>li.active a {
color: #40babd;
border-bottom: 2px solid #40babd;
background: none;
border-right: none
}

.theme-2 .view-account .side-bar .side-menu .nav>li.active a {
color: #6dbd63;
border-bottom-color: #6dbd63
}

.theme-3 .view-account .side-bar .side-menu .nav>li.active a {
color: #497cb1;
border-bottom-color: #497cb1
}

.theme-4 .view-account .side-bar .side-menu .nav>li.active a {
color: #ec6952;
border-bottom-color: #ec6952
}

.view-account .side-bar .side-menu .nav>li .icon {
display: block;
font-size: 24px;
margin-bottom: 5px
}

.view-account .content-panel {
padding: 30px
}

.view-account .content-panel .title {
margin-bottom: 15px;
margin-top: 0;
font-size: 18px
}

.view-account .content-panel .fieldset-title {
padding-bottom: 15px;
border-bottom: 1px solid #eaeaf1;
margin-bottom: 30px;
color: #616670;
font-size: 16px
}

.view-account .content-panel .avatar .figure img {
float: right;
width: 64px
}

.view-account .content-panel .content-header-wrapper {
position: relative;
margin-bottom: 30px
}

.view-account .content-panel .content-header-wrapper .actions {
position: absolute;
right: 0;
top: 0
}

.view-account .content-panel .content-utilities {
position: relative;
margin-bottom: 30px
}

.view-account .content-panel .content-utilities .btn-group {
margin-right: 5px;
margin-bottom: 15px
}

.view-account .content-panel .content-utilities .fa {
font-size: 16px;
margin-right: 0
}

.view-account .content-panel .content-utilities .page-nav {
position: absolute;
right: 0;
top: 0
}

.view-account .content-panel .content-utilities .page-nav .btn-group {
margin-bottom: 0
}

.view-account .content-panel .content-utilities .page-nav .indicator {
color: #a2a6af;
margin-right: 5px;
display: inline-block
}

.view-account .content-panel .mails-wrapper .mail-item {
position: relative;
padding: 10px;
border-bottom: 1px solid #f3f3f3;
color: #616670;
overflow: hidden
}

.view-account .content-panel .mails-wrapper .mail-item>div {
float: left
}

.view-account .content-panel .mails-wrapper .mail-item .icheck {
background-color: #fff
}

.view-account .content-panel .mails-wrapper .mail-item:hover {
background: #f9f9fb
}

.view-account .content-panel .mails-wrapper .mail-item:nth-child(even) {
background: #fcfcfd
}

.view-account .content-panel .mails-wrapper .mail-item:nth-child(even):hover {
background: #f9f9fb
}

.view-account .content-panel .mails-wrapper .mail-item a {
color: #616670
}

.view-account .content-panel .mails-wrapper .mail-item a:hover {
color: #494d55;
text-decoration: none
}

.view-account .content-panel .mails-wrapper .mail-item .checkbox-container,
.view-account .content-panel .mails-wrapper .mail-item .star-container {
display: inline-block;
margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa {
color: #a2a6af;
font-size: 16px;
vertical-align: middle
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa.fa-star {
color: #f2b542
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa:hover {
color: #868c97
}

.view-account .content-panel .mails-wrapper .mail-item .mail-to {
display: inline-block;
margin-right: 5px;
min-width: 120px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject {
display: inline-block;
margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label {
margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label:last-child {
margin-right: 10px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a,
.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a:hover {
color: #fff
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-1 {
background: #f77b6b
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-2 {
background: #58bbee
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-3 {
background: #f8a13f
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-4 {
background: #ea5395
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-5 {
background: #8a40a7
}

.view-account .content-panel .mails-wrapper .mail-item .time-container {
display: inline-block;
position: absolute;
right: 10px;
top: 10px;
color: #a2a6af;
text-align: left
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .attachment-container {
display: inline-block;
color: #a2a6af;
margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .time {
display: inline-block;
text-align: right
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .time.today {
font-weight: 700;
color: #494d55
}

.drive-wrapper {
padding: 15px;
background: #f5f5f5;
overflow: hidden
}

.drive-wrapper .drive-item {
width: 130px;
margin-right: 15px;
display: inline-block;
float: left
}

.drive-wrapper .drive-item:hover {
box-shadow: 0 1px 5px rgba(0, 0, 0, .1);
z-index: 1
}

.drive-wrapper .drive-item-inner {
padding: 15px
}

.drive-wrapper .drive-item-title {
margin-bottom: 15px;
max-width: 100px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis
}

.drive-wrapper .drive-item-title a {
color: #494d55
}

.drive-wrapper .drive-item-title a:hover {
color: #40babd
}

.theme-2 .drive-wrapper .drive-item-title a:hover {
color: #6dbd63
}

.theme-3 .drive-wrapper .drive-item-title a:hover {
color: #497cb1
}

.theme-4 .drive-wrapper .drive-item-title a:hover {
color: #ec6952
}

.drive-wrapper .drive-item-thumb {
width: 100px;
height: 80px;
margin: 0 auto;
color: #616670
}

.drive-wrapper .drive-item-thumb a {
-webkit-opacity: .8;
-moz-opacity: .8;
opacity: .8
}

.drive-wrapper .drive-item-thumb a:hover {
-webkit-opacity: 1;
-moz-opacity: 1;
opacity: 1
}

.drive-wrapper .drive-item-thumb .fa {
display: inline-block;
font-size: 36px;
margin: 0 auto;
margin-top: 20px
}

.drive-wrapper .drive-item-footer .utilities {
margin-bottom: 0
}

.drive-wrapper .drive-item-footer .utilities li:last-child {
padding-right: 0
}

.drive-list-view .name {
width: 60%
}

.drive-list-view .name.truncate {
max-width: 100px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis
}

.drive-list-view .type {
width: 15px
}

.drive-list-view .date,
.drive-list-view .size {
max-width: 60px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis
}

.drive-list-view a {
color: #494d55
}

.drive-list-view a:hover {
color: #40babd
}

.theme-2 .drive-list-view a:hover {
color: #6dbd63
}

.theme-3 .drive-list-view a:hover {
color: #497cb1
}

.theme-4 .drive-list-view a:hover {
color: #ec6952
}

.drive-list-view td.date,
.drive-list-view td.size {
color: #a2a6af
}

@media (max-width:767px) {
.view-account .content-panel .title {
    text-align: center
}
.view-account .side-bar .user-info {
    padding: 0
}
.view-account .side-bar .user-info .img-profile {
    width: 60px;
    height: 60px
}
.view-account .side-bar .user-info .meta li {
    margin-bottom: 5px
}
.view-account .content-panel .content-header-wrapper .actions {
    position: static;
    margin-bottom: 30px
}
.view-account .content-panel {
    padding: 0
}
.view-account .content-panel .content-utilities .page-nav {
    position: static;
    margin-bottom: 15px
}
.drive-wrapper .drive-item {
    width: 100px;
    margin-right: 5px;
    float: none
}
.drive-wrapper .drive-item-thumb {
    width: auto;
    height: 54px
}
.drive-wrapper .drive-item-thumb .fa {
    font-size: 24px;
    padding-top: 0
}
.view-account .content-panel .avatar .figure img {
    float: none;
    margin-bottom: 15px
}
.view-account .file-uploader {
    margin-bottom: 15px
}
.view-account .mail-subject {
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}
.view-account .content-panel .mails-wrapper .mail-item .time-container {
    position: static
}
.view-account .content-panel .mails-wrapper .mail-item .time-container .time {
    width: auto;
    text-align: left
}
}

@media (min-width:768px) {
.view-account .side-bar .user-info {
    padding: 0;
    padding-bottom: 15px
}
.view-account .mail-subject .subject {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}
}

@media (min-width:992px) {
.view-account .content-panel {
    min-height: 800px;
    border-left: 1px solid #f3f3f7;
    margin-left: 200px
}
.view-account .mail-subject .subject {
    max-width: 280px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}
.view-account .side-bar {
    position: absolute;
    width: 200px;
    min-height: 600px
}
.view-account .side-bar .user-info {
    margin-bottom: 0;
    border-bottom: none;
    padding: 30px
}
.view-account .side-bar .user-info .img-profile {
    width: 120px;
    height: 120px
}
.view-account .side-bar .side-menu {
    text-align: left
}
.view-account .side-bar .side-menu .nav {
    display: block
}
.view-account .side-bar .side-menu .nav>li {
    display: block;
    float: none;
    font-size: 14px;
    border-bottom: 1px solid #f3f3f7;
    margin-right: 0;
    margin-bottom: 0
}
.view-account .side-bar .side-menu .nav>li>a {
    display: block;
    color: #9499a3;
    padding: 10px 15px;
    padding-left: 30px
}
.view-account .side-bar .side-menu .nav>li>a:hover {
    background: #f9f9fb
}
.view-account .side-bar .side-menu .nav>li.active a {
    background: #f9f9fb;
    border-right: 4px solid #40babd;
    border-bottom: none
}
.theme-2 .view-account .side-bar .side-menu .nav>li.active a {
    border-right-color: #6dbd63
}
.theme-3 .view-account .side-bar .side-menu .nav>li.active a {
    border-right-color: #497cb1
}
.theme-4 .view-account .side-bar .side-menu .nav>li.active a {
    border-right-color: #ec6952
}
.view-account .side-bar .side-menu .nav>li .icon {
    font-size: 24px;
    vertical-align: middle;
    text-align: center;
    width: 40px;
    display: inline-block
}
}
    </style>
</head>
<body>


<div class="container">
	<h2 class="title">Edit Profile</h2>
	<hr>
	<form class="form-horizontal" method ="post" action="update-student.php">
		<fieldset class="fieldset">
			<h2 class="fieldset-title">Personal Info</h2>
			<div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">MIS</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="mis" disabled class="form-control" value="<?php echo $mis;?>">
				</div>
			</div>
			<input type="hidden" name="bool" value="<?php echo $bool;?>">
			<input type="hidden" name="mis" value="<?php echo $mis;?>">
			<input type="hidden" name="first_name" value="<?php echo $info['first_name'];?>">
			<input type="hidden" name="middle_name" value="<?php echo $info['middle_name'];?>">
			<input type="hidden" name="last_name" value="<?php echo $info['last_name'];?>">
	
			<div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="f_name" disabled class="form-control" value="<?php echo $info['first_name'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">Middle Name</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="m_name" disabled class="form-control" value="<?php echo $info['middle_name']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="l_name" disabled class="form-control" value="<?php echo $info['last_name']; ?>">
				</div>
			</div>
			 <div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">Religion</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="religion" class="form-control" value="<?php echo $row['religion']; ?>">
				</div>
			</div>
			 <div class="form-group">
				<label class="col-md-2 col-sm-3 col-xs-12 control-label">Caste</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="caste" class="form-control" value="<?php echo $row['caste']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Aadhar</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="aadhar" class="form-control" value="<?php echo $row['aadhar_no'] ;?>">
					<p class="help-block">Enter aadhaar number</p>
				</div>
			</div>
		</fieldset>
		<fieldset class="fieldset">
			<h2 class="fieldset-title">Contact Info</h2>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="email" name="email" class="form-control" value="<?php echo $row['email_id']; ?>">
					<p class="help-block">This is the email </p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Contact Number</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="contact_num" class="form-control" value="<?php echo $row['contact_number']; ?>">
					<p class="help-block">Your contact number</p>
				</div>
			</div>
			
		</fieldset>
		<fieldset class="fieldset">
		<h2 class="fieldset-title">Address Info</h2>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Home</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="home_add" class="form-control" value="<?php echo $row['home_address'] ;?>">
					<p class="help-block">Your home address</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Street</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="street_add" class="form-control" value="<?php echo $row['street_address']; ?>">
					<p class="help-block">Your street address</p>
				</div>
			</div>
				<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">City</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="city_add" class="form-control" value="<?php echo $row['city_address'] ;?>">
					<p class="help-block">City Address</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Country</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="country_add" class="form-control" value="<?php echo $row['country_address']; ?>">
					<p class="help-block">Country address</p>
				</div>
			</div>
			<fieldset class="fieldset">
			<h2 class="fieldset-title">Academic Details</h2>
				<fieldset class="fieldset">
				<h3 class="fieldset-title">Tenth Details</h3>
				<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Board</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="10board" class="form-control" value="<?php echo $row['10th_board']; ?>">
					<p class="help-block">For ex CBSE/ICSE</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Marks</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="10marks" class="form-control" value="<?php echo $row['10th_marks']; ?>">
					<p class="help-block">For ex 98%</p>
				</div>
			</div>
				<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Year of Passing</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="10yop" class="form-control" value="<?php  echo $row['10th_yop']; ?>">
					<p class="help-block">For ex 2014</p>
				</div>
			</div>
			</fieldset>
			<fieldset class="fieldset">
				<h3 class="fieldset-title">Twelfth Details</h3>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Board</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="12board" class="form-control" value="<?php echo $row['12th_board']; ?>">
					<p class="help-block">For ex CBSE/ICSE</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Marks</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<input type="text" name="12marks" class="form-control" value="<?php echo $row['12th_marks']; ?>">
					<p class="help-block">For ex 98 </p>
				</div>
			</div>
				<div class="form-group">
				<label class="col-md-2  col-sm-3 col-xs-12 control-label">Year of Passing</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				<?php
					echo "<input type='text' name='12yop' class='form-control' value='".$row['12th_yop']."'/>";
					?>
					<p class="help-block">For ex 2014</p>
				</div>
			</div>
			</fieldset>
		</fieldset>
		<hr>
		<div class="form-group">
			<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
				<button class="btn btn-primary" onclick="back();" type="reset" value="Go Back">
				<input class="btn btn-primary" name="submit" type="submit" value="Update Profile" style="float:right;">
			</div>
		</div>
	</form>
                
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>

</body>
</html>
<?php
}
?>
