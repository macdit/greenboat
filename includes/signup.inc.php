<?php

/** check if form submitted */
/** Redirect user to the signup form*/

if(isset($_POST['submit'])){

 /* Connect to the database */
 include_once 'db.inc.php';

/* Get the actual user's inputs */
/* User escape function: converts to text */
 $first = mysqli_real_escape_string($conn, $_POST['first']);
 $last = mysqli_real_escape_string($conn, $_POST['last']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $uid = mysqli_real_escape_string($conn, $_POST['uid']);
 $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

 // User's inputs validation/Errors handlers 
 // Check for error first before success
 
 } else {
 	//2) Check if input characters are valid
 	if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
 		 header("Location: ../signup.php?signup=invalid");
	     exit();

 	} else {
 		// 3)  Check if entered email is valid
 		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
 		header("Location: ../signup.php?signup=invalidemail");
	    exit();
 		} else {
 			// 4) Check if entered username already in the db
 			$sql = "SELECT * FROM members WHERE user_uid='$uid'";
 			$result = mysqli_query($conn, $sql);
 			$resultCheck = mysqli_num_rows($result);

 			// If any result, throw error message
 			if ($resultCheck > 0){
 				header("Location: ../signup.php?signup=usernametaken");
	            exit();

 			} else {
 				//Hash entered password
 				$encyptPwd = password_hash($pwd, PASSWORD_DEFAULT);

 				//Insert the new user to the database
 				$sql ="INSERT INTO members (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email','$uid', '$encyptPwd');";
 				$result = mysqli_query($conn, $sql);

 				//Redirect user back to the 
 				header("Location: ../signup.php?signup=success");
	            exit();
 			}

 		}
 	}
 }


} else {
	header("Location: ../signup.php");
	exit();
}





