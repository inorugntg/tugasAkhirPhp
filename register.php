<html>
<head>
	<h1>
        Register User
    </h1>
    <style>
		h1 {
			color: silver;
			text-align: center;
		}
		button[type="submit"], button[type="button"] {
		background-color: blue;
		color: white;
		padding: 10px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}
	</style>
    <link rel="stylesheet" href="register.css">
</head>

<body>
<a href="index.php"></a> <br />
<?php
include("config.php");

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if($user == "" || $pass == "" || $name == "" ) {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
		mysqli_query($link, "INSERT INTO login(name, username, password) VALUES('$name', '$user', md5('$pass'))")
			or die("Could not execute the insert query.");
			
		echo "Registration successfully";
		echo "<br/>";
		echo "<a href='login.php'>Login</a>";
	}
} else {
?>
<form name="form1" method="post" action="">
	<table width="75%" border="0">
		<tr> 
			<td width="10%">Full Name:</td>
			<td><input type="text" name="name"></td>
		</tr>		
		<tr> 
			<td>Username:</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr> 
			<td>Password:</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Submit">
				<a href="login.php"><button type="button">Back</button></a>
			</td>
		</tr>
	</table>
</form>

<?php
}
?>
</body>
</html>
