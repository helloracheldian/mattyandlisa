<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : '';
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php if(isset($_SESSION['success'])) : ?>
		<meta http-equiv="refresh" content="3; url=index.html">
	<?php elseif(!empty($errors)) : ?>
		<meta http-equiv="refresh" content="3; url=index.html#don">
	<?php endif ;?>
	<meta charset="UTF-8">
	<title>
		<?php if(isset($_SESSION['success'])) : ?>
			Thank you ! Your information has been sent successfully.
		<?php elseif(!empty($errors)) : ?>
			Oops! Something Went Wrong.
		<?php endif ;?>
	</title>
	<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			background-color: #f7f0e3;
		}
		.container {
			width:50%;
			min-height: 250px;
			padding:50px;
			font-size:20px;
			text-align:center;
			margin:0px auto;
			background:#fff;
			color:#000;
			margin-top:100px;
			border-radius: 15px;
			font-family: 'Lora', serif;
		}
		.container h2 {
			margin-bottom: 20px;
		}
		.success {
			color: #2c523c;
		}
		.error {
			color: #2c523c;
		}
		.error ul li {
			list-style: none;
			font-family: 'Lora', serif;
			color: #2c523c;
		}
		@media only screen and (max-width: 1070px) {
			.container {
				width: 90%;
				padding: 15px 5px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- Form Notification Start -->
		<?php if(isset($_SESSION['success'])) : ?>
			<div class="success">
				<h2>Thank you!</h2>
				<p>Your RSVP has been sent successfully!</p>
				<p>Taking you back to adamandbri.ca now...</p>
				<?php unset($fields); ?>

			</div>
		<?php elseif(!empty($errors)) : ?>
			<div class="error">
				<h2>Oops! Something went wrong.</h2>
				<ul><li><?php echo implode("</li><li>", $errors) ?></li></ul>
			</div>
		<?php endif ;?>
		<!-- Form Notification End -->
	</div>
</body>
</html>
<?php
session_unset();
session_destroy();
?>