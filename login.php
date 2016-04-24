<?php
	include "include/session.php";
	include "database.php";
	include "uploader.php";
	$welcome = false;
	if(!isset($_SESSION['admin'])){
		if(!empty($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$valid = true;

			if(!ctype_alnum($username)){
				$usernameError = "Username must be alphanumeric characters";
				$valid = false;
			}		
			if(!ctype_alnum($password)){
				$passwordError = "Password must be alphanumeric characters";
				$valid = false;
			}
			if(empty($username)){
				$usernameError = "Username cannot be empty";
				$valid = false;
			}
			if(empty($password)){
				$passwordError = "Password cannot be empty";
				$valid = false;
			}
			if($valid){
				$username = filter_var($username, FILTER_SANITIZE_STRING);
				$password = filter_var($password, FILTER_SANITIZE_STRING);
				$password = sha1($password);

				$dbConnect = database::connect();
				$query = "SELECT * FROM admin WHERE username = :username AND password = :password";
				$prepare = $dbConnect->prepare($query);
				$prepare->bindParam(":username", $username, PDO::PARAM_STR);
				$prepare->bindParam(":password", $password, PDO::PARAM_STR, 40);
				$prepare->execute();
				$exist = $prepare->fetchColumn();

				if($exist){
					database::disconnect();
					$dbConnect = database::connect();
					$prepare = $dbConnect->prepare($query);
					$prepare->bindParam(":username", $username, PDO::PARAM_STR);
					$prepare->bindParam(":password", $password, PDO::PARAM_STR, 40);
					$prepare->execute();
					$getData = $prepare->fetch(PDO::FETCH_ASSOC);

					$_SESSION['admin'] = $getData['id'];
					header("Location: index.php");
				} else{
					echo "<script> alert('Invalid Username or Password'); </script>";
				}

			}
		}
	} else {
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<?php include "include/header.php" ?>
	<style type="text/css">
	.form {
		height: 370px;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="css/newitem.css">
	<div class="form" >
		<form action="login.php" method="post" class="innerForm">
			<label>Username: </label>
			<input type="text" name="username" value="<?php echo !empty($username) ? $username : '' ?>" ></input>
			<label class="warning"><?php echo !empty($usernameError) ? $usernameError : "" ?></label>
			<label>Password: </label>
			<input type="password" name="password"></input>
			<label class="warning"><?php echo !empty($passwordError) ? $passwordError : "" ?></label>
			<input type="submit" name="login" value="Login" class="btnSell"></input>
		</form>
	</div>
	<?php include "include/footer.php" ?>
		</div>
	</body>
</html>