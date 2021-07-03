<?php
$con = mysqli_connect("localhost","root","","social_media") or die ("connection was not established");
function getTopics(){
	global $con;

$get_topics = "select * from topics";
$run_topics = mysqli_query($con,$get_topics);

while($row=mysqli_fetch_array($run_topics)) {
	$topic_id = $row['topic_id'];
	$topic_title = $row['topic_name'];

	echo "<option value='$topic_id'>$topic_title</option>";
}
}

function insertPost() {
if(isset($_POST['sub'])) {
	global $con;
	global $user_id;
	$title = addslashes($_POST['title']);
	$content = addslashes($_POST['content']);
	$topic = $_POST['topic'];

	if($content=='' OR $title=='')
	{
		echo "<h2> Please enter a topic </h2>";
		exit();
	}
	else{
		$insert = "insert into posts
		(user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";

		$run = mysqli_query($con,$insert);

		if($run) {
			echo "<div class='post' style='margin-left:45px'><h3>Posted to timeline </h3></div>";

	 	$update = "update users set posts='yes' where user_id='$user_id'";
	 	$run_update = mysqli_query($con,$update);
		}
		echo "<script>alert('Your post has been posted!')</script>";
	}
}
}

function get_posts() {
	global $con;

	$per_page = 3;

	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}
	$start_form = ($page-1) * $per_page;
	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_form, $per_page";
	$run_posts = mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)) {
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = substr($row_posts['post_content'],0,150);
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "<div class='col pos' style='margin-top:40px;'><div id='posts'>
		<p><img src='images/$user_image' width='50' height='50'> </p>
		<h3><a href ='user_profile.php?u_id=$user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		<a href='single.php?post_id=$post_id' class='btn btn-primary'> See Replies or Reply to this </a>
		<div><br/></div>
		";
	}
	include("pagination.php");

}

function single_post(){
	if(isset($_GET['post_id'])){
		global $con;
		$get_id = $_GET['post_id'];
		$get_posts = "select * from posts where post_id='$get_id'";

		$run_posts= mysqli_query($con,$get_posts);
		$row_posts = mysqli_fetch_array($run_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		$user="select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];
		//session nibo
		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con,$get_com);
		$row_com=mysqli_fetch_array($run_com);
		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];

		echo "
		<div class='col pos' style='margin-top:40px; margin-left :20px;margin-bottom :40px;'><div id='posts'>
		<p><img src='images/$user_image' width='50' height='50'></p>
		<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		</div>
		";
		include("comments.php");

		echo "
		<form action='' method='post' id='reply'>
		<textarea cols='50' rows='5' name='comment' placeholder='Write your reply'></textarea><br/>
		<button class = 'btn btn-primary' type='submit' name='reply' style:'margin-bottom :20px;'> Reply to this </button>
		</form>
		";
		if(isset($_POST['reply'])) {
			$comment = $_POST['comment'];
			$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";
		$run = mysqli_query($con,$insert);
		echo "<h2> Your reply was added! </h2>";
					}

	}
}

function members() {

	global $con;

	$user = "select * from users";
	$run_user = mysqli_query($con,$user);

	while($row_user=mysqli_fetch_array($run_user)) {
		$user_id = $row_user['user_id'];
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

echo "
<span>
<a href='user_profile.php?u_id=$user_id'>
<img src='images/$user_image' width='50' height = '50' title='$user_name' style='float:left' 'margin-bottom:50px';/></span>
";
	}
}

function user_posts() {
	global $con;

	if(isset($_GET['u_id'])) {
		$u_id = $_GET['u_id'];
	}

	$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";
	$run_posts = mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user=mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "
		<div id='post' style='margin-top : 60px; margin-right:40px;'>
		<p><img src='images/$user_image' width='50' height='50'></p>
		<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		<a href='single.php?post_id=$post_id' style='float:right;margin-left :5px'><button class='btn btn-primary'> View </button></a>
		<a href='edit_post.php?post_id=$post_id' style = 'float:right;margin-left :5px'><button class='btn btn-primary'> Edit </button></a>
		<a href='functions/delete_post.php?post_id=$post_id' style='float:right;margin-left :5px'><button class='btn btn-primary'> Delete </button></a>

		</div><br/>

		";
		include("delete_post.php");
	}
}

function user_profile(){
	if(isset($_GET['u_id'])) {

		global $con;

		$user_id = $_GET['u_id'];

		$select = "select * from users where user_id='$user_id'";
		$run = mysqli_query($con,$select);
		$row = mysqli_fetch_array($run);

		$id = $row['user_id'];
		$image = $row['user_image'];
		$name = $row['user_name'];
		$department = $row['user_department'];
		$gender = $row['user_gender'];
		$last_login = $row['user_last_login'];
		$register_date = $row['user_reg_date'];

		if($gender=='Male') {
			$msg="Send him a message";
		}
		else {
			$msg="Send her a message";
		}

		echo "<div class='container'> <div id='user_profile'>
		<img src='images/$image' width = '150' height='150' /><br/>
		<p style='margin-top : 10px;'><strong>  Name : </strong>$name </p><br/>
		<p><strong>  Gender : </strong>$gender </p><br/>
		<p><strong>  Department : </strong>$department </p><br/>
		<p><strong>  Last Login : </strong>$last_login</p><br/>
		<p><strong>  Member Since : </strong>$register_date </p><br/>
		<button><a href='messages.php?u_id=$id'>$msg</a><br/></button>
		</div> </div>
		";



	}


}
function show_topics() {
	global $con;

	if(isset($_GET['topic'])) {
		$id = $_GET['topic'];
	}

	$get_posts = "select * from posts where topic_id='$id'";
	$run_posts = mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user=mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "
		<div id='post'>
		<p><img src='images/$user_image' width='50' height='50'></p>
		<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		<a href='single.php?post_id=$post_id' style=''><button class=' btn btn-primary'> View </button></a>
		<a href='edit_post.php?post_id=$post_id' style = ''><button class=' btn btn-primary'> Edit </button></a>
		<a href='functions/delete_post.php?post_id=$post_id'><button class=' btn btn-primary'> Delete </button></a>

		</div><br/>

		";
		include("delete_post.php");
	}
}
function results() {
	global $con;

	if(isset($_GET['search'])) {
		$search_query = $_GET['user_query'];
	}

	$get_posts = "select * from posts where post_title like '%$search_query%' OR post_content like '%$search_query%'";
	$run_posts = mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user=mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "
		<div id='post'>
		<p><img src='images/$user_image' width='50' height='50'></p>
		<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		<a href='single.php?post_id=$post_id'><button class='btn btn-primary'> View </button></a>
		<a href='edit_post.php?post_id=$post_id'><button class='btn btn-primary'> Edit </button></a>
		<a href='functions/delete_post.php?post_id=$post_id'><button class='btn btn-primary'> Delete </button></a>

		</div><br/>

		";
		include("delete_post.php");
	}
}





?>
