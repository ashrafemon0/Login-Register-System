<?php

session_start();

if (isset($_SESSION['username'])) {
	
	$_SESSION['msg'] = "You Must Login View to the Page";
	header("Location: login.php");
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("Location: login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
<h1>This is the home page</h1>
<?php if (isset($_SESSION['username'])) : ?>

<div>
	<h3>
		<?php

			echo $_SESSION['sucess'];
			unset($_SESSION['sucess']);

		?>


	</h3>
</div>
<?php endif ?>

//if the user login print information about him

<?php if (isset($_SESSION['username'])); ?>
<h3>Welcome<strong><?php if (isset($_SESSION['username'])) : ?></strong></h3>

<button><a href="index.php?logout='1'"></a>logout</button>
<?php endif ?>
</body>
</html>