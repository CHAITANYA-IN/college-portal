<?php
session_start();
session_destroy();
header("Location: course-display.php");
?>