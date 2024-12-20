
<?php
session_start();
ob_start();

?>


<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/design.css">

</head>

<body>


	<?php
	$password = $username = "";
	$passwordErr = $usernameErr = "";
	

	//Name 
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$flag = false;

		if (empty($_POST["username"])) {
			$usernameErr = "*Username is required";
			$flag = true;
		} else {

			$username = sanitize($_POST["username"]);
			$flag = false;

		}


		if (empty($_POST["password"])) {
			$passwordErr = "*Password is required";
			$flag = true;
		} else {
			$password = sanitize($_POST["password"]);
			$flag = false;

		}

		if ($flag === false) {

			include "db_con.php";

			function authenticateAdmin($username, $password, $conn) {
				// Define SQL query to retrieve password for the provided username
				$sql = "SELECT password FROM admin WHERE username = :username";
			
				// Parse the SQL query
				$statement = oci_parse($conn, $sql);
			
				// Bind parameters
				oci_bind_by_name($statement, ':username', $username);
			
				// Execute the query
				oci_execute($statement);
			
				// Fetch the result (password)
				$row = oci_fetch_assoc($statement);
				
				if ($row) {
					$db_pass = $row["PASSWORD"];
			
					// Verify password
					if ($password == $db_pass) {
						return true; // Authentication successful
					}
				}
			
				return false; // Authentication failed
			}
			
			// Function to authenticate user
			function authenticateUser($username, $password, $conn) {
				// Define SQL query to retrieve password for the provided username
				$sql = "SELECT password FROM users WHERE username = :username";
			
				// Parse the SQL query
				$statement = oci_parse($conn, $sql);
			
				// Bind parameters
				oci_bind_by_name($statement, ':username', $username);
			
				// Execute the query
				oci_execute($statement);
			
				// Fetch the result (password)
				$row = oci_fetch_assoc($statement);
				
				if ($row) {
					$db_pass = $row["PASSWORD"];
			
					// Verify password
					if ($password == $db_pass) {
						return true; // Authentication successful
					}
				}
			
				return false; // Authentication failed
			}

				// Check if admin authentication is successful
				if (authenticateAdmin($username, $password, $conn)) {
					$_SESSION['x'] = true;
					$_SESSION['admin'] = $username;
					header('Location: admin_dashboard.php');
					exit; // Make sure to exit after redirection
				} elseif (authenticateUser($username, $password, $conn)) {
					$_SESSION['y'] = true;
					$_SESSION['user'] = $username;
					header('Location: user_dashboard.php');
					exit; // Make sure to exit after redirection
				} else {
					echo "<br><center><strong>*Invalid username or password</strong></center>";
				}
			
				// Close the database connection
				oci_close($conn);
			

	}

	}

	function sanitize($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>


	<div class="login-container">
		<form class="login-form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" novalidate>
			<h2>Login</h2>

			<div class="input-group">

				<input class="log-input" type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">

				<span id="username_err"></span>

				<span class=err>
					<?php echo $usernameErr; ?>
				</span>

			</div>

			<div class="input-group">

				<input class="log-input" type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">

				<span id="password_err"></span>

				<span class=err>
					<?php echo $passwordErr; ?>
				</span>

			</div>


			<input class="log-button" type="submit" name="login" value="Login">
		</form>
	</div>

	<div>
    <a href="website.php">
      <img class="social-img-login go-up-btn-login" src="pictures/go-up.png">
    </a>

  </div>

</body>

</html>