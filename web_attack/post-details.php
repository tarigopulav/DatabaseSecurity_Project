<?php
	session_start();
	include('database_connect.php');
	include('xss.php');

	include('Token.php');
?>

<!doctype html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="style/index.css" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.css">

		<style>
			.container{
				min-width: 100%;
			}

			.container > .row {
				margin: 0;
			}


			.container > .row > .col {
				padding: 0;
			}

			*{
				padding: 0px;
				margin: 0px;
				font-family: 'Changa';
			}
		</style>
	</head>
	
	<body>
		
		<div class="ui container">
			<div class="ui grid">
				<div class="ten wide centered column">
					<div class="ui fluid menu">
						<a href="index.php" class="item">Home</a>
						
						<?php 
							if(!isset($_SESSION['user_id'])){
								echo '<a href="login.php" class="item">Login</a>';
							}else{
								echo '<a href="index.php?action=logout" class="item">Logout</a>';

								//echo '<a href="#" class="item">'. $_SESSION["username"]; .'</a>';
								echo '<a href="#" class="item">' . $_SESSION['username'] .'</a>';
							}
						?>

						<a href="all-post.php" class="item">All post</a>

					</div>
				</div>
			</div>
		</div>


		<div class="ui grid">
			<div class="ten wide centered column">
				<h3>Details post </h3>
				
				<?php
					$id = xss($_GET['id']);
					$sql = "select * from posts where id=$id";
					$rows = $conn->query($sql);

					foreach($rows as $row){
						$id = xss($row['id']);
						$title = xss($row['title']);
						$details = xss($row['detail']);

						?>

						<div class="" style="margin-top: 40px;">
							<p><?php echo "ID: " . $id; ?></>
							<h3><?php echo "Title: " . $title ?></h3>
							<h3><?php echo "Details: " . $details ?></h3>
						</div>

						<?php
					}
				?>
			

			</div>
		</div>
	</body>
</html>