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

	if(isset($_POST['name'], $_POST['rsvp'], $_POST['rsvp2'])) {
			$fields = array(
				'name'		=> $_POST['name'],
				'rsvp'		=> $_POST['rsvp'],
				'rsvp2'		=> $_POST['rsvp2']
			);

			foreach ($fields as $field => $data) {
				if(empty($data)) {
					//$errors[] = "The " . $field . " is required";
					$errors[] = "Please ensure the form is filled out entirely.";
					break 1;
				}
			}



			if(!empty($_POST['name2'])) {
				if(empty($_POST['g2rsvp'])) {
					$errors[] = "You've missed guest 2's Ceremony.";
				}

				if(empty($_POST['g2rsvp2'])) {
					$errors[] = "You've missed guest 2's Brunch.";
				}				

			}




			if(empty($errors) === true) {
				$name 		= test_input($_POST['name']);
				$rsvp 		= test_input($_POST['rsvp']);
				$rsvp2 		= test_input($_POST['rsvp2']);
				

				$name2 		= test_input($_POST['name2']);

				if(!empty($_POST['name2'])) {				
					$g2rsvp 	= test_input($_POST['g2rsvp']);
					$g2rsvp2 	= test_input($_POST['g2rsvp2']);
				} else {
					$g2rsvp 	= "";
					$g2rsvp2 	=  "";
				}


				$music 		= test_input($_POST['music']);
				$diet 		= test_input($_POST['diet']);
				$message 	= test_input($_POST['message']);

				$to 		= "hello@foxandfancy.com";
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
										<th>Ceremony</th>
										<td>$rsvp</td>
									</tr>
									<tr>
										<th>Brunch</th>
										<td>$rsvp2</td>
									</tr>
								</table>
								<h4>Group Two</h4>
								<table style='min-width:300px'>
									<tr>
										<th>Name</th>
										<td>$name2</td>
									</tr>
									<tr>
										<th>Ceremony</th>
										<td>$g2rsvp</td>
									</tr>
									<tr>
										<th>Brunch</th>
										<td>$g2rsvp2</td>
									</tr>
									<tr>
										<th>Music</th>
										<td>$music</td>
									</tr>
									<tr>
										<th>Diet</th>
										<td>$diet</td>
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
			    $headers .= 'From:Matty and Lisa <No-Reply@mattyandlisa.ca>' . "\r\n";
			    // $headers .= 'Reply-To: <'. $email .'>' . "\r\n";

			    mail($to,$subject,$body,$headers);

			    $_SESSION['success'] = "Success";
			    
				header('location: index.php#form');
				exit();
			
			} elseif(empty($errors) === false) {
				$_SESSION['fields'] = $fields;
				$_SESSION['errors'] = $errors;
				header('location: index.php#form');
				exit();
			}


	} else {
		$errors[] = "Please ensure the form is filled out entirely.";
		$_SESSION['fields'] = $fields;
		$_SESSION['errors'] = $errors;
		header('location: index.php#form');
		exit();
	}
	
} else {
	header('Location: index.php');
	exit();


}
?>