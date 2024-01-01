<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  // Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
  $mail->isSMTP(); //Send using SMTP
  $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
  $mail->SMTPAuth = true; //Enable SMTP authentication
  $mail->Username = 'chiennguyen1702@gmail.com'; //SMTP username
  $mail->Password = 'rdrsesqylyedubmi'; //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
  $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  // Recipients
  $mail->setFrom('chiennguyen1702@gmail.com', 'PHPMailer Testing');
  $mail->addAddress($_POST['email']); //Add a recipient
  // $mail->addAddress('ellen@example.com'); //Name is optional
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  // Attachments with image data url
  if ($_POST['imageDataUrl'] != "") {
    // Your image data URI (base64-encoded)
    $imageDataUrl = $_POST['imageDataUrl'];

    // Extracting MIME type and base64-encoded image data from data URI
    list($type, $data) = explode(";", $imageDataUrl);
    list(, $data) = explode(',', $data);
    list(, $ext) = explode('/', $type);

    // Decoding base64-encoded image data
    $decodedData = base64_decode($data);

    // Image name
    $imageName = $_POST['imageName'];

    // Add the attachment with image data
    $mail->addStringAttachment($decodedData, $imageName, 'base64', $type);
  }
  if ($_POST['imageDataUrl02'] != "") {
    // Your image data URI (base64-encoded)
    $imageDataUrl02 = $_POST['imageDataUrl02'];

    // Extracting MIME type and base64-encoded image data from data URI
    list($type02, $data02) = explode(";", $imageDataUrl02);
    list(, $data02) = explode(',', $data02);
    list(, $ext02) = explode('/', $type02);

    // Decoding base64-encoded image data
    $decodedData02 = base64_decode($data02);

    // Image name
    $imageName02 = $_POST['imageName02'];

    // Add the attachment with image data
    $mail->addStringAttachment($decodedData02, $imageName02, 'base64', $type02);
  }

  // Content
  $mail->isHTML(true);
  $mail->Subject = $_POST['title'];
  $mail->Body = <<<EOD
    <p>Your title: {$_POST['title']}</p>
    <p>Your email: {$_POST['email']}</p>
    <p>Your phone: {$_POST['phone']}</p>
    <p>Your message: {$_POST['message']}</p>
  EOD;

  // check send email
  $isSent = $mail->send();

  if ($isSent) {
    header("Location: http://phpmailer.local/thankyou.php");
    exit;
  } else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
  }
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
