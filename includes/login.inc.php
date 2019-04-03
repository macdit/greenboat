<?php

//Start a session
session_start();

if (isset($_POST['submit'])){

	//Include the database connection
	include 'db.inc.php';

	//Get submited form values via $_POST[] securely
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd= mysqli_real_escape_string($conn, $_POST['pwd']);
     

     //Validate user's inputs
	//1) Check if any field is empty
	if (empty($uid) || empty($pwd)){

		header("Location: ../index.php?login=empty");
	    exit();
	} else {

		//Check if the username exist in the db.
		// OR email exist as username too
		$sql = "SELECT * FROM members WHERE user_uid ='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1){
			header("Location: ../index.php?login=error");
	        exit();	
		} else {
			// Insert return user's data to raw
			if ($row = mysqli_fetch_assoc($result)){

				// Check if password inside db matched 
				//Entered password after de-hashing
				$verifyPasswordMatch = password_verify($pwd, $row['user_pwd']);

				//Check the result 
				if($verifyPasswordMatch == false){
					// If false, redirect to the login page
					header("Location: ../index.php?login=error");
					exit();
				} elseif ($verifyPasswordMatch == true){
					// If entered password matched stored password
					// Login the user using session variable - superglable variable
					// Allowed user to login 

					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];

                    // Redirect user to the main page with login success
					header("Location: ../personal.php");

					exit();


				}

			}
		}
	}

} else {
	header("Location: ../index.php?login=error");
	exit();
}