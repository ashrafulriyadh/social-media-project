<?php
session_start();
include("includes/connection.php");



if(isset($_POST['Login'])) {
$email = mysqli_real_escape_string($con,$_POST['email']);
$pass = mysqli_real_escape_string($con,$_POST['pass']);


$select_user = "select * from users where user_email='$email' AND user_pass='$pass' AND status='verified'";

$query = mysqli_query($con,$select_user);
$check_user = mysqli_num_rows($query);


if($check_user==1) {
	$_SESSION['user_email'] = $email;
	header("location: home.php");
	// echo "<script>window.open('home.php','_self')</script>";
}
else {
	// echo "<script>alert('login failed')</script>";
	echo "
	<script type='text/javascript'>alert(' login failed');</script>
	";
}

}
?>