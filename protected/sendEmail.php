<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

// Configure an SMTP
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->SMTPDebug = 3; //Alternative to above constant
$mail->isSMTP();
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;
$mail->Username = 'apikey';
$mail->Password = getenv('SENDGRID_API_KEY');
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;


// Recipients
// $mail->setFrom('admin@thekatalyst.group', 'TKG Website');
// $mail->addAddress('admin@thekatalyst.group', 'Website Admin');
// $mail->addReplyTo($email, $name);
