<?php

if(isset($_POST['btnSubmit']))
{ // button name
	// EDIT THE 2 LINES BELOW AS REQUIRED
	$email_to = " office@go1scout.com";
	$email_subject = "New Message";

	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}


	// validation expected data exists
	if(!isset($_POST['txtName']) ||
		!isset($_POST['txtEmail']) ||
		!isset($_POST['txtPhone']) ||
		!isset($_POST['txtMsg'])){
		died('We are sorry, but there appears to be a problem with the form you submitted.');
	}



	$name = $_POST['txtName']; // required
	$email_from = $_POST['txtEmail']; // required
	$telephone = $_POST['txtPhone']; // required
	$msg=$_POST['txtMsg']; //required

	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

	if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}

	$string_exp = "/^[A-Za-z .'-]+$/";

	if(!preg_match($string_exp,$first_name)) {
		$error_message .= 'The First Name you entered does not appear to be valid.<br />';
	}

	if(!preg_match($string_exp,$last_name)) {
		$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
	}

	if(strlen($order) < 2) {
		$error_message .= 'The Comments you entered do not appear to be valid.<br />';
	}

	if(strlen($error_message) > 0) {
		died($error_message);
	}

	$email_message = "Order details:\n\n";


	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}



	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Message: ".clean_string($msg)."\n";

	// create email headers
	$headers = 'From: '.$email_to."\r\n".
'Reply-To: '.$email_to."\r\n" .
'X-Mailer: PHP/' . phpversion();
	if(mail($email_to, $email_subject, $email_message, $headers) && mail($email_from, $email_subject, $email_message, $headers)){
		exit();
	}
	else{
		echo "Error: Message not accepted";
	}
}else{

}

?>