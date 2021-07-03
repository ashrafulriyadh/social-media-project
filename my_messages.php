<!doctype html>
<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
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
  <body>
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
</div>
</nav>
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
            <div class='card' style='width: 18rem; height : auto; margin-top 40px; background-color:#ADD9E6;'>
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
    		<div id="msg" style="margin-left: 50px;margin-top : 50px">
			
			<p align="center">
			<a href="my_messages.php?inbox"> My inbox </a> || 
			<a href="my_messages.php?sent"> Sent Items </a>
			</p>
			
			<?php 
			
			if(isset($_GET['sent'])) {
			include("sent.php");
			
				
			}
			?>
			
			<?php if(isset($_GET['inbox'])) {?>
			<table width ="800">
			<tr>
			
			<th> Sender : </th>
			<th> Subject : </th>
			<th> Date : </th>
			<th> Reply </th>
			
			</tr>
			<?php
			
			$sel_msg = "select * from messages where receiver = '$user_id' ORDER BY 1 DESC";
			$run_msg = mysqli_query($con,$sel_msg);
			
			$count_msg = mysqli_num_rows($run_msg);
			
			while($row_msg = mysqli_fetch_array($run_msg))
			{
				$msg_id = $row_msg['msg_id'];
				$msg_receiver = $row_msg['receiver'];
				$msg_sender = $row_msg['sender'];
				$msg_sub = $row_msg['msg_sub'];
				$msg_topic = $row_msg['msg_topic'];
				$msg_date = $row_msg['msg_date'];
				
				$get_sender = "select * from users where user_id='$msg_sender'";
				$run_sender = mysqli_query($con,$get_sender);
				$row = mysqli_fetch_array($run_sender);
				
				$sender_name = $row['user_name'];
			
			/*while($row = mysqli_fetch_array($run_sender))
			{
				$sender_name = $row['user_name'];
			}*/
			
			
			
			?>
			
			<tr align="center">
			<td>
			<a href="user_profile.php?u_id=<?php echo $msg_sender;?>" target="blank">
			<?php echo $sender_name;?></a>
			</td>
			<td>
			<a href="my_messages.php?inbox&msg_id=<?php echo $msg_id; ?>">
			<?php echo $msg_sub; ?></a>
			</td>
			<td><?php echo $msg_date; ?></td>
			<td><a href="my_messages.php?inbox&msg_id=<?php echo $msg_id;?>"> Reply </a></td>
			</tr>
			<?php } ?>
			
			<?php } ?>
			</table>
			
			<?php 
			if(isset($_GET['msg_id'])) {
				
				$get_id = $_GET['msg_id'];
			
				$sel_message = "select * from messages where msg_id='$get_id'";
				$run_message = mysqli_query($con,$sel_message);
				
				$row_message = mysqli_fetch_array($run_message);
				
				$msg_subject = $row_message['msg_sub'];
				$msg_topic = $row_message['msg_topic'];
				$reply_content = $row_message['reply'];
				
				$update_unread = "update messages set status='read' where msg_id='$get_id'";
				$run_unread = mysqli_query($con,$update_unread);
				
				echo "<center><br/><hr>
				<h2> $msg_subject </h2>
				<p><b> Message : </b> $msg_topic </p>
				<p><b> My Reply : </b> $reply_content </p>
				
				<form action='' method='post'>
				<textarea cols='30' row='5' name='reply'></textarea><br/>
				<input type='submit' name='msg_reply' value='Reply to this'/>
				</form>
				</center>
				";
			}
			if(isset($_POST['msg_reply'])) {
				
				$user_reply = $_POST['reply'];
				
				if($reply_content!='no_reply'){
					echo "<h2 align='center'> This message was already replied!</h2>";
					exit();
			}
			else {
				$update_msg = "update messages set reply='$user_reply' where msg_id='$get_id' AND reply='no_reply'";
				
				$run_update= mysqli_query($con,$update_msg);
				echo "<h2 align='center'> Message was Replied!</h2>";
			}
			}
			
			
			?>
			
			
    		
    		</div>
    </div>
     <?php
include("template/scripts.php");
?>

