<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

// Configure an SMTP
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//$mail->SMTPDebug = 3; //Alternative to above constant
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'kemish.hendershot@gmail.com';
$mail->Password = 'tkes qrvi gqji cumn';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Recipients
$mail->addAddress('kemish.hendershot@gmail.com', 'Website Admin');
$mail->addReplyTo('info@tbcutah.com');
