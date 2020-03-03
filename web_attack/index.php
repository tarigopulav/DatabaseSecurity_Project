<?php
	session_start();
	include('database_connect.php');
	include('xss.php');

	include('Token.php');

	/*$date = new DateTime('+1 week');
	setcookie('username', 'amir', $date->getTimestamp());
	setcookie('password', '12345678', $date->getTimestamp());
	setcookie('session', 'Nsdbjhyubh7665jhsbijjhuy367876', $date->getTimestamp());*/
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

		<?php
			if(isset($_GET['action']) == 'logout'){
				session_destroy();
				header('location: index.php');
			}

			if(isset($_POST['title'], $_POST['details'])){
				$title = $_POST['title'];
				$details = $_POST['details'];
				
				if(!empty($title) && !empty($details)){
					//csrf demonstration start
					
					//start csrf protection code

					/*if(isset($_POST['token'])){
						if(Token::check($_POST['token'])){
							$sql = 'INSERT into posts(title, detail) values("'. $title .'", "'. $details .'")';
							$conn->query($sql);

							$msg = "Post created!";

							//header('location:index.php?title='.$title.'&details='.$details);
						}else{
							$err_msg = "Invalid token!";
						}
					}else{
						$err_msg = "Invalid token!";
					}*/

					//end csrf protection code
					

					//without csrf protection start

					$sql = 'INSERT into posts(title, detail) values("'. $title .'", "'. $details .'")';
					$conn->query($sql);

					$msg = "Post created!";
					
					//without csrf protection end

					//csrf demonstration end

				}else{
					$err_msg = "Both title and details are required!";
				}
			}
		?>

		<div class="ui grid">
			
			<!--left side-->
            <div class="ten wide centered column ">

                <div class="ui centered stackable grid">
                    <div class="sixteen wide column">


                        <h2 style="color: navy;">Create a post?</h2>
                        
                        <form method="post">

							<?php 
								if(isset($err_msg)){
							?>
								<div class="ui small red message" style="margin-top: 50px;">
									<?php echo $err_msg; ?>
								</div>
							<?php 
								}
							?>
                                
							<?php 
								if(isset($msg)){
							?>
								<div class="ui small red message" style="margin-top: 50px;">
									<?php echo $msg; ?>
								</div>
							<?php 
								}
							?>


                            <div class="ui attached message" style="margin-top: 20px;">
                                <div class="header">
                                    Create post
                                </div>
                            </div>

                            <div class="ui form attached fluid segment">

                                <div class="field" style="margin-top: 30px;">
                                    <div class="ui labeled input">
                                        <div class="ui label" style="width: 90px;">
                                            Title
                                        </div>

                                        <input type="text" name="title" class="title" id="title" placeholder="Post Title" />
                                    </div>
                                </div>

                                <div class="field" style="">
                                    <div class="ui labeled input">
                                        <div class="ui label" style="width: 90px;">
                                            Details
                                        </div>

                                        <input type="text" name="details" class="details" id="details" placeholder="Post Detail" />
                                    </div>
                                </div>

								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                                <button type="submit" name="post-btn" class="ui violet submit button" style="margin-bottom: 20px;">CREATE POST</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!--end left side-->
		</div>



		<!--search form-->

		<?php

			if(isset($_POST['search'])){
				$search = $_POST['search'];
				
				header('Location:search-result.php?s='. $search);
			}

		?>

		<div class="ui grid">
				
			<div class="ten wide centered column" style="margin-top: 30px;">
				<h3>Search post?</h3>
				<form method="post">
					
					<div class="ui attached message" style="margin-top: 20px;">
                        <div class="header">
                            Search post
                        </div>
                    </div>

                    <div class="ui form attached fluid segment">

                        <div class="field" style="">
                            <div class="ui labeled input">
                                <div class="ui label" style="width: 90px;">
                                    Search
                                </div>

                                <input type="text" name="search" id="search" placeholder="Search" />
                            </div>
                        </div>

                        <button type="submit" name="search-btn" class="ui violet submit button" style="margin-bottom: 20px;">Search</button>
                    </div>

				</form>
			</div>
			<!--search form-->

		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.js"></script>
	</body>
</html>