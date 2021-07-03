<?php
$query ="select * from posts";
$result = mysqli_query($con, $query);

$total_post= mysqli_num_rows($result);

$total_pages = ceil($total_post / $per_page);

echo "
<center>
<div id='pagination'>
<a href='home.php?page=1' style='margin-right:10px;'>First Page </a>
";

for($i=1; $i<=$total_pages; $i++){
	echo "<a href='home.php?page=$i'>$i</a>";
}

echo "<a href='home.php?page=$total_pages' style='margin-left:10px;'>Last Page </a></center></div>";

?>
