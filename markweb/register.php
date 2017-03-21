<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		require('dbConnector.php');
		
		$username = trim($_POST['username']);
		$pass1 = trim($_POST['password1']);
		$pass2 = trim($_POST['password2']);
		
		$select = "SELECT Username FROM users WHERE Username = ?";
		
		$errors = "";
	
		$selectStmt = mysqli_prepare($dbc, $select);
		
		mysqli_stmt_bind_param($selectStmt, 's', $username);
		
		if (mysqli_stmt_execute($selectStmt)) {
			
			/* bind result variables */
			mysqli_stmt_bind_result($selectStmt, $name);
			
			mysqli_stmt_fetch($selectStmt);
			
			//echo mysqli_stmt_num_rows($stmt);
			mysqli_stmt_close($selectStmt);
			
			// Check username and password match
			if ( strcmp($name, '') == 0 ) {
				$errors = createUser($username, $pass1, $pass2);
			}
			else {
				$errors = "Hey... You fuck! That name is chosen already. Quit being a douchebag.";
			}
		}
		
		echo $errors;
		
	}
	
	function createUser($username, $pass1, $pass2) {
		$uppercase = preg_match('@[A-Z]@', $pass1);
		$lowercase = preg_match('@[a-z]@', $pass1);
		$number    = preg_match('@[0-9]@', $pass1);
		
		$errors = "";
		
		$regex = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$";
		
		if (strlen($username) > 7) {
			if ($uppercase && $lowercase && $number && strlen($pass1)) {
				if (strcmp($pass1, $pass2) == 0) {
					// TODO: Here's where you write up the SQL query and redirect the user
					// Include database connection settings
					require('dbConnector.php');

					// Retrieve username and password from database according to user's input
					$query = "INSERT INTO Users(Username, Password) VALUES (?, ?);";
					
					$stmt = mysqli_prepare($dbc, $query);
					
					mysqli_stmt_bind_param($stmt, 'ss', $username, $pass1);
					
					if (mysqli_stmt_execute($stmt)) {
						header('Location: /markweb/login.php');
					}
				}
				else {
					$errors = "Oh no... You fucked up. Passwords must match.";
				}
			}
			else {
				$errors = "Oh no... You fucked up. Password must be at least 8 characters long and contain one upper case letter, one lower case letter, and one number.";
			}
		}
		else {
			$errors = "Oh no... You fucked up. Please enter a username with a minimum of eight characters.";
		}
		return $errors;
	}
?>

<!DOCTYPE html>
<html>
	<body>

		<p>You're one step away from endless fun!.</p>
		<form action="/markweb/register.php" method = "post">
			Requested Username:<br>
			<input type="text" name="username" placeholder="Username">
			<br>
			Password:<br>
			<input type="password" name="password1" placeholder="Password">
			<br>
			Retype Password:<br>
			<input type="password" name="password2" placeholder="Password">
			<br><br>
			<input type="submit" value="Submit">
		</form> 

	</body>
</html>