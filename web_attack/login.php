<!doctype html>
<html>
	<head>
		<title>login</title>
		<link rel="stylesheet" type="text/css" href="style/login.css" />
	</head>
	
	<body>
		<?php
			include('database_connect.php');
			include('xss.php');

			session_start();

			if(isset($_POST['login-btn'])){
				$username = $_POST['username'];
				$password = $_POST['login-password'];

				$result = $conn->prepare("select count(id) from users where username=:username and password='$password'");
				$result->bindParam(':username', $username, PDO::PARAM_INT);
				$result->execute();
				$total_found = $result->fetchColumn();

				if($total_found > 0){

					$sql = "select * from users where username='$username' and password='$password'";
					$rows = $conn->query($sql);

					foreach($rows as $row){
						$user_id = $row['id'];
						$user_name = $row['username'];
					}

					$_SESSION['user_id'] = $user_id;
					$_SESSION['username'] = $user_name;


					header('location: index.php');
				}else{
					$err_msg =  "User not found!";

					if(isset($_SESSION['err_counter'])){
						$_SESSION['err_counter'] = $_SESSION['err_counter'] + 1;


						if($_SESSION['err_counter'] > 4){
							$err_msg1 = "Login limit exeed!";
						}


					}else{
						$_SESSION['err_counter'] = 1;
					}
					
				}
			}
		?>

		<form method="post">
			<div class="login">
				<p>
					<label style="width: 100%; border-bottom: 2px solid gray;font-size: 20px;">Login</label>
				</p>

				<p style="margin-top: 30px;">
					<label for="username">User Name : </label>

					<?php
						if(isset($_SESSION['err_counter'])){
							if($_SESSION['err_counter'] > 4){
								echo '<input type="text" name="username" class="username" disabled id="username" placeholder="amir" />';
							}else{
								echo '<input type="text" name="username" class="username" id="username" placeholder="amir" />';
							}
						}else{
							echo '<input type="text" name="username" class="username" id="username" placeholder="amir" />';
						}
					?>
				</p>

				<p>
					<label for="login-password">Password : </label>
					
					<?php
						if(isset($_SESSION['err_counter'])){
							if($_SESSION['err_counter'] > 4){
								echo '<input type="password" name="login-password" id="login-password" class="login-password" disabled placeholder="Password" />';
							}else{
								echo '<input type="password" name="login-password" id="login-password" class="login-password" placeholder="Password" />';
							}
						}else{
							echo '<input type="password" name="login-password" id="login-password" class="login-password" placeholder="Password" />';
						}
					?>
				</p>

				<?php
					if(isset($err_msg)){
						echo '<p style="background-color: white;">';
							echo $err_msg;
						echo '</p>';
					}
				?>

				<?php
					if(isset($err_msg1)){
						echo '<p style="background-color: white;">';
							echo $err_msg1;
						echo '</p>';
					}

					if(isset($_SESSION['err_counter'])){
						if($_SESSION['err_counter'] > 4){
							echo '<p style="background-color: white;">';
								echo "Login limit exceed! Please clear your history to login again!";
							echo '</p>';
						}
					}
				?>

				<p style="background-color: white;">
					<?php
						
						if(isset($_SESSION['err_counter'])){
							if($_SESSION['err_counter'] > 4){
								echo '<button type="submit" name="login-btn" class="login-btn" disabled style="color: white; border: 1px solid white; background-color: grey;">Login</button>';
							}else{
								echo '<button type="submit" name="login-btn" class="login-btn">Login</button>';
							}
						}else{
							echo '<button type="submit" name="login-btn" class="login-btn">Login</button>';
						}
					?>
				</p>
			
				
				<p>
					<label style="width: 100%;font-size: 14px;">*Not registred, registration <a style="color: orange;" href="registration.php">here</a></label>
				</p>

				<div class="footer">
					<p style="font-size: 12px;margin-left: 20px;margin-top: 5px;line-height: 55px;">
						Developed by ***.
					</p>
				</div>

			</div>
		</form>
	</body>
</html>
