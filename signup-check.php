<?php 
session_start(); 
include "config.php";

if (isset($_POST['name']) && isset($_POST['username'])
    && isset($_POST['password'])) {

	function validate($link){
       $link = trim($link);
	   $link = stripslashes($link);
	   $link = htmlspecialchars($link);
	   return $link;
	}

	$name = validate($_POST['name']);
	$username = validate($_POST['username']);
	$pass = validate($_POST['password']);

	$user = 'name='. $name. '&username='. $username;

	if (empty($name)) {
		header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}

	else if(empty($username)){
        header("Location: signup.php?error=Username is required&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM login WHERE username='$username' ";
		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO login(username, password, name) VALUES('$username', '$pass', '$name')";
           $result2 = mysqli_query($link, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}