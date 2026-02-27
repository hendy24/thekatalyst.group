<?php
require __DIR__ . '/../protected/sendEmail.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /home");
    exit;
}

/* -----------------------------
   Honeypot
----------------------------- */
$website = trim($_POST['website'] ?? '');
if ($website !== '') {
    header("Location: /?status=success");
    exit;
}

/* -----------------------------
   Normalize Name
----------------------------- */
$nameParts = [];

if (!empty($_POST['name'])) {
    $nameParts[] = trim($_POST['name']);
} else {
    if (!empty($_POST['first_name'])) {
        $nameParts[] = trim($_POST['first_name']);
    }
    if (!empty($_POST['last_name'])) {
        $nameParts[] = trim($_POST['last_name']);
    }
}

$name = trim(implode(' ', $nameParts));

/* -----------------------------
   Other Fields
----------------------------- */
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$city        = trim($_POST['city'] ?? '');
$messageText = trim($_POST['message'] ?? '');

/* -----------------------------
   Basic Validation
----------------------------- */
if ($name === '' || $email === '' || $messageText === '') {
    header("Location: /?status=error");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: /?status=error");
    exit;
}

/* -----------------------------
   Build Email + SMS Content
----------------------------- */
$subject = "Website contact inquiry";

$html =
    "From: " . htmlspecialchars($name) . "<br>" .
    "Email: " . htmlspecialchars($email) . "<br>" .
    ($phone !== '' ? "Phone: " . htmlspecialchars($phone) . "<br>" : '') .
    ($city !== '' ? "City: " . htmlspecialchars($city) . "<br>" : '') .
    "Message:<br>" . nl2br(htmlspecialchars($messageText));

$sms =
    "🔥 NEW CONTACT\n" .
    "{$name}\n" .
    ($phone !== '' ? "📞 {$phone}\n" : '') .
    "✉ {$email}\n" .
    ($city !== '' ? "🏙 {$city}\n" : '') .
    "💬 " . substr($messageText, 0, 200);

/* -----------------------------
   Send Notifications
----------------------------- */
try {
    tkg_notify($email, $name, $subject, $html, $sms);
    header("Location: /?status=success");
    exit;
} catch (Exception $e) {
    error_log("Mail error: " . $e->getMessage());
    header("Location: /?status=error");
    exit;
}