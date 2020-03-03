<!doctype html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="style/index.css" />
	</head>
	
	<body>
		
		<?php
		/*
			if(isset($_POST['post-btn'])){
				$title = $_POST['title'];
				//$details = $_POST['details'];

				$sql = 'INSERT into posts(title) values("'. $title .'")';
				$conn->query($sql);

			}
			*/
		?>

		<div class="post_form">
			<form method="post" action="http://localhost/web_attack/web_attack/index.php">
				<div class="login">
					<p>
						<label style="width: 100%; border-bottom: 2px solid gray;font-size: 20px;">Create Post</label>
					</p>

					<p style="margin-top: 30px;">
						<label for="title">Title : </label>
						<input type="text" name="title" class="title" id="title" placeholder="Post Title" />
					</p>

					<p style="margin-top: 30px;">
						<label for="details">Detail : </label>
						<input type="text" name="details" class="details" id="details" placeholder="Post Detail" />
					</p>
					
					<p style="background-color: white;">
						<button type="submit" name="post-btn" class="post-btn">POST</button>
					</p>
				</div>
			</form>
		</div>
	</body>
</html>