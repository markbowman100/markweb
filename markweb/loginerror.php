<?php
	// Inialize session
	session_start();
	
	// Include database connection settings
	require('dbConnector.php');

	// Retrieve username and password from database according to user's input
	$query = "SELECT Username FROM users WHERE Username = ? and Password = ?";
	
	$stmt = mysqli_prepare($dbc, $query);
	
	mysqli_stmt_bind_param($stmt, 'ss', $_POST['username'], $_POST['password']);
	
	if (mysqli_stmt_execute($stmt)) {
		
		/* bind result variables */
		mysqli_stmt_bind_result($stmt, $name);
		
		mysqli_stmt_fetch($stmt);
		
		echo $name;
		
		//echo mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
		
		// Check username and password match
		if ( strcmp($name, '') != 0 ) {
			// Set username session variable
			$_SESSION["username"] = $name;
			SESSION_WRITE_CLOSE();
			// Jump to secured page
			header('Location: /markweb/welcome.php');
		}
	}
?>

<!DOCTYPE html>
<html>
	<body>

		<p>You have entered an incorrect Username or Password. Please try again or <a href="/markweb/register.php">register.</a></p>
		<form action="/markweb/loginerror.php" method = "post">
			Username:<br>
			<input type="text" name="username" placeholder="Username">
			<br>
			Password:<br>
			<input type="password" name="password" placeholder="Password">
			<br><br>
			<input type="submit" value="Submit">
		</form> 

	</body>
</html>