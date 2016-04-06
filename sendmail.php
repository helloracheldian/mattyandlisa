<?php
if(empty($_POST) === false) {

	session_start();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	

	$errors = array();

	if(isset($_POST['name'], $_POST['rsvp'])) {
			$fields = array(
				'name'		=> $_POST['name'],
				'rsvp'		=> $_POST['rsvp'],
			);

			foreach ($fields as $field => $data) {
				if(empty($data)) {
					//$errors[] = "The " . $field . " is required";
					$errors[] = "Please ensure the form is filled out entirely.";
					break 1;
				}
			}


			if($_POST['rsvp'] == 'Yes' and empty($_POST['meal'])) {
				$meal 		= "Not";
				$errors[]	= "The meal choice for Guest 1 was missing.";
			}


			if(!empty($_POST['name2'])) {
				if(empty($_POST['rsvp2'])) {
					$errors[] = "You've missed guest 2's RSVP.";
				}

				if($_POST['rsvp2'] == 'Yes' and empty($_POST['meal2'])) {
					$meal 		= "Not";
					$errors[]	= "The meal choice for Guest 2 was missing.";
				}

			}




			if(empty($errors) === true) {
				$name 		= test_input($_POST['name']);
				$rsvp 		= test_input($_POST['rsvp']);
				
				if($_POST['rsvp'] == 'Yes') {
					$meal = test_input($_POST['meal']);
				} else {
					$meal = "Empty";
				}

				$name2 		= test_input($_POST['name2']);
				$rsvp2 		= test_input($_POST['rsvp2']);

				if($_POST['rsvp2'] == 'Yes') {
					$meal2 = test_input($_POST['meal2']);
				} else {
					$meal2 = "Empty";
				}

				$message 	= test_input($_POST['message']);

				$to 		= "hello@adamandbri.ca";
				$subject 	= "You have a new RSVP from " . $name;
				
				$body 		= "
					<html>
						<head>
							<title></title>
							<style>
								* {
									margin: 0;
									padding: 0;
								}
								body {
									background-color: #EEEEEE;
								}
								.main {
									width: 960px;
									margin: 0 auto;
									background-color: white;
									padding: 100px;
								}
								h4 {
									color: navy;
									font-size: 15px;
								}
								h5 {
									color: darkred;
									margin-top: 10px;
									font-size: 16px;
								}
								table {
									margin-top: 15px;
									margin-bottom: 16px;
								}
								table, tr, th, td {
									border: 1px solid lightGray;
									border-collapse: collapse;
								}
								th {
									font-size: 15px;
									font-weight: normal;
									line-height: 25px;
									padding: 5px;
									text-align: left;
									color: darkred;
								}
								td {
									font-size: 15px;
									font-weight: normal;
									line-height: 25px;
									padding: 5px;
									text-align: left;
									color: darkgreen;
								}
							</style>
						</head>
						<body>
							<div class='main'>
								<h4>RSVP from $name:</h4>
								<h4>Group One</h4>
								<table style='min-width:300px'>
									<tr>
										<th>Name</th>
										<td>$name</td>
									</tr>
									<tr>
										<th>RSVP</th>
										<td>$rsvp</td>
									</tr>
									<tr>
										<th>Meal</th>
										<td>$meal</td>
									</tr>
								</table>
								<h4>Group Two</h4>
								<table style='min-width:300px'>
									<tr>
										<th>Name</th>
										<td>$name2</td>
									</tr>
									<tr>
										<th>RSVP</th>
										<td>$rsvp2</td>
									</tr>
									<tr>
										<th>Meal</th>
										<td>$meal2</td>
									</tr>
									<tr>
										<th>Message</th>
										<td>$message</td>
									</tr>
								</table>
							</div>
						</body>
					</html>
				";

			    // Always set content-type when sending HTML email
			    $headers = "MIME-Version: 1.0" . "\r\n";
			    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			    // More headers
			    $headers .= 'From:Adam and Bri <No-Reply@adamandbri.ca>' . "\r\n";
			    // $headers .= 'Reply-To: <'. $email .'>' . "\r\n";

			    mail($to,$subject,$body,$headers);

			    $_SESSION['success'] = "Success";
			    
				header('location: index.php#don');
				exit();
			
			} elseif(empty($errors) === false) {
				$_SESSION['fields'] = $fields;
				$_SESSION['errors'] = $errors;
				header('location: index.php#don');
				exit();
			}


	} else {
		$errors[] = "Please ensure the form is filled out entirely.";
		$_SESSION['fields'] = $fields;
		$_SESSION['errors'] = $errors;
		header('location: index.php#don');
		exit();
	}
	
} else {
	header('Location: index.php');
	exit();


}
?>