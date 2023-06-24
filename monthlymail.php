<?php
require 'connectDB.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$sender = 'abuadattendance@gmail.com';
$sendername = 'ABUAD attendance';

try {
	// Get the current month and year
	$currentMonth = date('m');
	$currentYear = date('Y');

	// Retrieve the email addresses from the 'users' table
	$result = mysqli_query($conn, "SELECT email, username FROM users");
	if (!$result) {
		die('Error retrieving email addresses: ' . mysqli_error($conn));
	}

	while ($row = mysqli_fetch_assoc($result)) {
		$reciever = $row['email'];
		$name = $row['username'];

		// Retrieve the 'time_in' and 'time_out' logs for the current month and year
		$logResult = mysqli_query($conn, "SELECT time_in, time_out FROM logs WHERE MONTH(date) = $currentMonth AND YEAR(date) = $currentYear");
		if (!$logResult) {
			die('Error retrieving logs: ' . mysqli_error($conn));
		}

		// Generate the email body
		$body = "Monthly Time Logs for $name:<br><br>";
		while ($logRow = mysqli_fetch_assoc($logResult)) {
			$timeIn = $logRow['time_in'];
			$timeOut = $logRow['time_out'];
			$body .= "Time In: $timeIn<br>";
			$body .= "Time Out: $timeOut<br><br>";
		}

		try {
			// Server settings
			$mail->isSMTP(); // Send using SMTP
			$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
			$mail->SMTPAuth = true; // Enable SMTP authentication
			$mail->Username = 'abuadattendance@gmail.com'; // SMTP username
			$mail->Password = 'ecfxzqbpeabehdzx'; // SMTP password
			$mail->SMTPSecure = 'tls'; // Enable TLS encryption
			$mail->Port = 587; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			// Recipients
			$mail->setFrom($sender, $sendername);
			$mail->addAddress($reciever, $name); // Add a recipient
			$mail->addReplyTo($sender, $sendername);

			// Content
			$mail->isHTML(true); // Set email format to HTML
			$mail->Subject = 'Monthly Time Logs';
			$mail->Body = $body;

			$mail->send();
			echo "Email sent to $reciever<br>";
		} catch (Exception $e) {
			echo "Error sending email to $reciever: " . $mail->ErrorInfo . "<br>";
		}
	}

	// Close the database connection
	mysqli_close($conn);
} catch (Exception $e) {
	echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
?>
