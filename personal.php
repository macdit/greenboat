<?php 
	if (!isset($_SESSION["u_id"])) {
		//Redirect user to the home page 
		header("Location:index.php");
	}

?>
<html>
	<h1>Hi <?=$_SESSION['u_id']?></h1>
</html>