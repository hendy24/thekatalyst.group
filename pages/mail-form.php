<?php
require __DIR__ . '/../protected/sendEmail.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /home");
    exit;
}

$website = trim($_POST['website'] ?? ''); // honeypot
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$city    = trim($_POST['city'] ?? '');
$messageText = trim($_POST['message'] ?? '');

// Basic validation
if ($website !== '') {
    $message = "Message could not be sent.";
} elseif ($name === '' || $email === '' || $messageText === '') {
    $message = "Message could not be sent.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Message could not be sent.";
} else {
    try {

        // Email from
        $mail->setFrom(CONTACT_EMAIL, "TKG Website");
        $mail->addAddress(CONTACT_EMAIL);
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Website contact inquiry";
        $mail->Body =
            "From: " . htmlspecialchars($name) . "<br>" .
            "Email: " . htmlspecialchars($email) . "<br>" .
            "City: " . htmlspecialchars($city) . "<br>" .
            "Message:<br>" . nl2br(htmlspecialchars($messageText));

        $mail->send();
        $message = 'Message has been sent';
    } catch (Exception $e) {
        // Optional: log the real error so you're not blind
        error_log("Mail error: " . $mail->ErrorInfo);
        $message = "Message could not be sent.";
    }
}

header("refresh:5;url=home");
?>
<br><br><br><br>
<div class="row my-5">
  <div class="col-md-12">
    <p class="display-4 text-center">Your <?php echo htmlspecialchars($message); ?></p>
  </div>
</div>
<br><br><br><br>