<!doctype html>
<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])) {
	header("location: index.php");
}

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="styles/home_style.css" media="all">


    <title>Uits Society</title>
  </head>
  <body style="background-color: #E9EBEE">
  <div>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand font-weight-bolder" href="#">Uits Society</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link font-weight-bolder" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active font-weight-bolder">
        <a class="nav-link" href="members.php">Members</a>
      </li>
      <li class="nav-item active font-weight-bolder">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Search Topics : </a>
      </li>
      <?php
                $get_topics = "select * from topics";
                $run_topics = mysqli_query($con,$get_topics);

                while($row=mysqli_fetch_array($run_topics)){
                    $topic_id = $row['topic_id'];
                    $topic_name = $row['topic_name'];

                    echo "<li class='navbar navbar-nav nav-item font-weight-bolder active'><a href='topic.php?topic=$topic_id' class='text-dark'>$topic_name</a></li>";
                }
                ?>

    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="results.php" >
      <input class="form-control mr-sm-2" type="text" name="user_query" placeholder="Search here" aria-label="Search">
      <button class="btn btn-dark my-2 my-sm-0" type="submit" name="search" value="Search">Search</button>
    </form>
  </div>
</nav>
</div>
    <div class="container-fluid">
    			<?php
          $user = $_SESSION['user_email'];
          $get_user = "select * from users where user_email='$user'";
          $run_user = mysqli_query($con,$get_user);
          $row = mysqli_fetch_array($run_user);

          $user_id = $row['user_id'];
          $user_name = $row['user_name'];
          $user_department = $row['user_department'];
          $user_image = $row['user_image'];
          $register_date = $row['user_reg_date'];
          $last_login = $row['user_last_login'];

          $user_posts = "select * from posts where user_id='$user_id'";
          $run_posts = mysqli_query($con,$user_posts);
          $posts = mysqli_num_rows($run_posts);

          //getting the number of unread msg
          $sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC";
          $run_msg = mysqli_query($con,$sel_msg);
          $count_msg = mysqli_num_rows($run_msg);

        echo "
            <div class='row'>
            <div class='col-sm-4 col-lg-2'>
            <div class='card' style='width: 18rem; height : auto; margin-top:65px; background-color:#ADD9E6;'>
        <img class='card-img-top' src='images/$user_image' width='200' height='200'> 
        <div id = 'user_mention'class='card-body'>
        <p><strong>Name: </strong> $user_name</p>
        <p><strong>Department : </strong>$user_department</p>
        <p><strong>Last Login : </strong>$last_login</p>
        <p><strong>Member Since: </strong>$register_date</p>

        <p><a href='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
        <p><a href='my_posts.php?u_id=$user_id'>My Posts ($posts)</a></p>
        <p><a href='edit_profile.php?u_id=$user_id'>Edit Account </a></p>
        <p><a href='logout.php'>Logout </a></p>
        </div></div></div>
        ";
          ?>
           <div class="card" style="margin-top: 30px; margin-left: 80px;">
<article class="card-body mx-auto" style="max-width: 400px;">
  <img src="images/uits.png" width="200" height="100" class="rounded mx-auto d-block" alt="">
  <h4 class="card-title mt-3 text-center">Edit your Account</h4>
  <form action="" method="post" id="f" class="ff" enctype="multipart/form-data">
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
     </div>
        <input class="form-control" type="text" name="u_name" required="required" value="<?php echo $user_name;?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
        <input class="form-control" type="email" name="u_email" required="required" placeholder="New Email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fas fa-venus-mars"></i> </span>
    </div>
    <select class="form-control" name="u_gender" disabled="disabled">
        <option selected="">Male</option>
        <option value="1">Female</option>
    </select>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
    </div>
    <select class="form-control"  name="u_department" disabled="disabled">
       <option selected=""><?php echo $user_department;?></option>
                <option>CSE</option>
                <option>IT</option>
                <option>CE</option>
                <option>BBA</option>
                <option>EEE</option>
                <option>ENGLISH</option>
                <option>LAW</option>
                <option>PHARMACY</option>
                <option>OTHERS</option>
    </select>
  </div> <!-- form-group end.// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input class="form-control" type="password" name="u_pass" required="required" placeholder="Write new password">
    </div> <!-- form-group// -->
    <label> Photo : </label>
        <input type="file" name="u_image" required="required">                                     
    <div class="form-group">
        <button type="submit" name="update" value="Update" class="btn btn-primary btn-block"> Update Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center"> You will get alert if successfull </p>     

</form>
</article>
</div>
    		
    		<!--   <div class="col-sm-7 col-lg-10">
        <div id="timeline">
			   <form action="" method ="post" id="f" class="ff" enctype="multipart/form-data">
			   <table>
			   <tr align="center">
			   <td colspan="6"><h2> Edit </h2></td>
			   </tr>
			   <tr>
			   <td align="right"> Name : </td>
			   <td>
			   <input type="text" name="u_name" required="required" value="<?php echo $user_name;?>"/>
			   </td>
			   </tr>
			   <tr>
			   <td align="right"> Password : </td>
			   <td>
			   <input type="password" name="u_pass" required="required" placeholder="Write new password" />
			   </td>
			   </tr>
			   <tr>
			   <td align="right">Email : </td>
			   <td>
			   <input type="email" name="u_email" required="required" placeholder="New Email"/>
			   </td>
			   </tr>
			   <tr>
			   <td align="right"> Department : </td>
			   <td>
			   <select name="u_department" disabled="disabled">
			   <option><?php echo $user_department;?></option>
			   <option>CSE</option>
                <option>IT</option>
                <option>CE</option>
                <option>BBA</option>
                <option>EEE</option>
                <option>ENGLISH</option>
                <option>LAW</option>
                <option>PHARMACY</option>
                <option>OTHERS</option>
              </select></td>
			  </tr>
			  <tr>
			  <td align="right"> Gender : </td>
			  <td>
			  <select name="u_gender" disabled="disabled">
			  <option> Male </option>
			  <option> Female </option>
			  </select>
			  </td>
			  </tr>
			  <tr>
			  <td align="right"> Photo : </td>
			  <td>
			  <input type="file" name="u_image" required="required"/>
			  </td>
			  </tr>
			  <tr align ="center">
			  <td colspan="6">
			  <input type="submit" name="update" value="Update"/>
			  </td>
			  </tr>
			  </table>
			</form> -->

<?php 
	if(isset($_POST['update'])) {
		$u_name = $_POST['u_name'];
		$u_pass = $_POST['u_pass'];
		$u_email = $_POST['u_email'];
		$u_image = $_FILES['u_image']['name'];
		$image_tmp = $_FILES['u_image']['tmp_name'];
		
		move_uploaded_file($image_tmp,"images/$u_image");
		
		$update = "update users set user_name = '$u_name' , user_pass='$u_pass' , user_email='$u_email',
		user_image='$u_image' where user_id='$user_id'";
		
		$run = mysqli_query($con,$update);
		
		if($run) {
			echo "<script>alert('Your Profile Updated!')</script>";
			echo "<script>window.open('home.php','_self')</script>";
		}
		
	}



?>
</div>
</div>
</div>
 <?php
include("template/scripts.php");
?>
			   
			   
			   
			   
			   