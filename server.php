<?php

session_start();

$username ="";
$email ="";

$error = array();

//conect database

$db = mysqli_connect('localhost','root','','register') or die("could not coneect database");


//Register User

	$username 	= 	mysqli_real_escape_string($db, $_POST['username']);
	$email 		= 	mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = 	mysqli_real_escape_string($db, $_POST['psw']);
	$password_2 = 	mysqli_real_escape_string($db, $_POST['psw-repeat']);

	// from validation

	if (empty($username)) array_push($error, "username is Must to be Empty");
	if (empty($email)) array_push($error, "email is Must to be Empty");
	if (empty($password_1)) array_push($error, "password is Must to be Empty");
	if (empty($password_1 != $password_2)) array_push($error, "password Dont Match");

//exiting user db and same username

	$userQuery = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";

	$result = mysqli_query($db, $userQuery);
	$user	= mysqli_fetch_assoc($result);

	if ($user) {
		if ($user['username']===$username) array_push($error, "The Username Already exix");
		if ($user['email']===$email) array_push($error, "The Email Already exix");
	}

	//Regiseter The Userif No Error

	if (count($error == 0)) {
		
		$password = md5($password_1);//encripted password
		$query = "INSERT INTO user (username,email,password) VALUES('$username','$email','$password' )";

		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['sucess'] = "Your Are Loged In";

		header("location: index.php");
	}


// login

	if (isset($_POST['login'])) {

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['pasword']);

	if (empty($username)) array_push($error, "username is Must to be Empty");
	if (empty($password)) array_push($error, "password is Must to be Empty");

	if (count($error) == 0) {
		
		$password = md5($password);
	}

	$logQuery = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($db, $logQuery);

	if (mysqli_num_row($result)) {
		
		$_SESSION['username'] = $username;
		$_SESSION['sucess'] = "Your Are Logedin Sucessfully";
		header("location: index.php");
	}else{
		array_push($error, "Username And Password Dont Match");
	}

	}





?>