<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendmail($tomail, $totmailname , $subject, $message)
{
	// $loginid 	= "onlineauctionprojectmail@myprojectcoding.xyz";
	$loginid 	= "004fa1aadd70df";
	$password 	= "82b07d9c71972d";
	$smtpserver = "smtp.mailtrap.io";
	// $smtpserver = "mail.myprojectcoding.xyz";
	$smtpport 	= 2525;
	// $smtpport 	= 26;
	$mailsender = "OnlineAuction";
	$companyname= "OnlineAuction";
	$facebook = "https://www.facebook.com/OnlineAuction";
	$twitter = "https://www.twitter.com/OnlineAuction";
	$youtube = "https://www.youtube.com/OnlineAuction";
	$linkedin = "https://www.linkedin.com/OnlineAuction";
	$companyaddress  = "onlineauction.com, 9-57, Wadi-e-Hadees, Hyderabad-500005, India | Email us: onlineauction@gmail.com";
	$contactno = "+91-9550313048";
	$url = "www.onlineauction.com";
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	// Load Composer's autoloader
	require_once 'PHPMailer/src/Exception.php';
	require_once 'PHPMailer/src/PHPMailer.php';
	require_once 'PHPMailer/src/SMTP.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);
	
		try{
			//Server settings
			// $mail->SMTPDebug = false;
			$mail->isSMTP();                                            
			$mail->Host       = 'smtp.mailtrap.io';                   
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = '004fa1aadd70df';                     
			$mail->Password   = '82b07d9c71972d';                               
			$mail->SMTPSecure = 'tls';        
			$mail->Port       =  2525;  
			
			//Recipients
			$mail->addAddress($tomail);            
			$mail->setFrom("noreply@example.com");
			// Content
			$mail->isHTML(true);     
			// Set email format to HTML
			// $mail->Subject = 'Here is the subject';
			$mail->Body    = $message;
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			if ($mail->Send()) {
				$result = 1;
			} else {
				$result = "Error: " . $mail->ErrorInfo;
			}
			// var_dump($mail->ErrorInfo);
			// die('done');
	}
	catch (Exception $e) 
	{
		echo "Message could not be sent. Mailer Error: {
			$mail->ErrorInfo}<br>";
			echo $e->getMessage();
	}
}
//sendmail("studentprojects.live@gmail.com", "Student Projects" , "My subject title", "My message");
?>