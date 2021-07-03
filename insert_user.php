<?php
include("includes/connection.php");

if(isset($_POST['sign_up']))
{
$name = mysqli_real_escape_string($con,$_POST['u_name']);
$pass = mysqli_real_escape_string($con,$_POST['u_pass']); 
$email = mysqli_real_escape_string($con,$_POST['u_email']);
$department = mysqli_real_escape_string($con,$_POST['u_department']);
$gender = mysqli_real_escape_string($con,$_POST['u_gender']);
$birthday = mysqli_real_escape_string($con,$_POST['u_birthday']);
$status = "unverified";
$posts = "no";
$ver_code = mt_rand();

if(strlen($pass)<8) {
	echo "<script>alert('password should be minimum 8 characters')</script>";
	exit();
}

$check_email = "select * from users where user_email='$email'";
$run_email = mysqli_query($con,$check_email);
$check = mysqli_num_rows($run_email);

if($check==1) {
	echo "<script>alert('This email has already registered')</script>";
	exit();
}
$insert = "insert into users (user_name,user_pass,user_email,user_department,user_gender,user_birthday,user_image,user_reg_date,status,ver_code,posts) values ('$name','$pass','$email','$department','$gender','$birthday','default.jpg',NOW(),'$status','$ver_code','$posts')";

$query = mysqli_query($con,$insert);

if($query) {
	echo "<script type='text/javascript'>alert(' HI, $name Congratulations, Registration is almost complete,Please wait for verification');</script>";

}
else {
	echo "
	<script type='text/javascript'>alert(' Registration failed, Try again');</script>";
}

}
?>