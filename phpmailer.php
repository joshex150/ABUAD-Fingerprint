<?php
require 'connectDB.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

if (isset($_POST['reciever'])) {
	$mail = new PHPMailer(true);
	$sender = 'abuadattendance@gmail.com';
	$sendername = 'ABUAD attendance';
	$recievername = '';
	// Get the email value from the POST request
	$reciever = $_POST['reciever'];

	// Generate a random 6-digit number
	$pass_reset = rand(100000, 999999);


	try {
		// Update the user's pass_reset value
		$sql = "UPDATE `login` SET pass_reset = '$pass_reset' WHERE email = '$reciever'";

		if (mysqli_query($conn, $sql)) {
			$result = mysqli_query($conn, "SELECT username FROM `login` WHERE email = '$reciever'");
			$row = mysqli_fetch_assoc($result);
			$name = $row['username'];
			$cookie_expiration = time() + (21600);
			setcookie('name', $name, $cookie_expiration, '/');
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
			$mail->isSMTP(); //Send using SMTP
			$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
			$mail->SMTPAuth = true; //Enable SMTP authentication
			$mail->Username = 'abuadattendance@gmail.com'; //SMTP username
			$mail->Password = 'ecfxzqbpeabehdzx'; //SMTP password
			$mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
			$mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom($sender, $sendername);
			$mail->addAddress($reciever, $name); //Add a recipient
			$mail->addReplyTo($sender, $sendername);

			//Content
			$mail->isHTML(true); //Set email format to HTML
			$mail->Subject = 'Password Reset for Attendance Website.';
			$mail->Body = "hello $name, your password reset code is $pass_reset";
			$mail->AltBody = "hello $name, The verification code is $pass_reset";

			$mail->send();
			header('Location: verify.php');
			exit();
		} else {
			echo 'Error updating pass reset value: ' . mysqli_error($conn);
		}

	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}';
	}
}