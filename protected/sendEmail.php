<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/configs.php';

require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';

function tkg_mailer(): PHPMailer {
    $mail = new PHPMailer(true);

    // Production: 0. Temporarily set to 2 when debugging.
    $mail->SMTPDebug  = 0;
    $mail->Debugoutput = 'error_log';

    $mail->isSMTP();
    $mail->Host       = 'smtp.sendgrid.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'apikey';
    $mail->Password   = getenv('SENDGRID_API_KEY') ?: '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->CharSet = 'UTF-8';

    return $mail;
}

/**
 * Email-to-SMS gateways can choke on emoji / odd unicode.
 * Keep SMS gateway payload plain and boring.
 */
function tkg_sms_sanitize(string $text): string {
    $text = trim($text);

    // Remove most emoji/unicode symbols (conservative)
    $text = preg_replace('/[\x{1F000}-\x{1FFFF}]/u', '', $text) ?? $text;

    // Normalize whitespace
    $text = preg_replace("/[ \t]+/", " ", $text) ?? $text;
    $text = preg_replace("/\n{3,}/", "\n\n", $text) ?? $text;

    return trim($text);
}

/**
 * Sends:
 *  - HTML email to SEND_TO_EMAIL
 *  - Plain-text SMS-gateway email to SEND_TO_SMS
 *
 * Returns: ['email' => bool, 'sms' => bool]
 */
function tkg_notify(string $replyToEmail, string $replyToName, string $subject, string $htmlBody, string $smsBody): array {
    $result = ['email' => false, 'sms' => false];

    // 1) EMAIL (HTML)
    if (defined('SEND_TO_EMAIL') && is_array(SEND_TO_EMAIL) && count(SEND_TO_EMAIL) > 0) {
        try {
            $mail = tkg_mailer();
            $mail->setFrom(CONTACT_EMAIL, 'TKG Website');
            $mail->addReplyTo($replyToEmail, $replyToName);

            foreach (SEND_TO_EMAIL as $r) {
                $r = trim((string)$r);
                if ($r !== '') $mail->addAddress($r);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = strip_tags(str_replace(["<br>", "<br/>", "<br />"], "\n", $htmlBody));

            $mail->send();
            $result['email'] = true;
        } catch (Exception $e) {
            error_log("TKG notify EMAIL failed: " . $e->getMessage());
        }
    }

    // 2) SMS Gateway (Plain Text)
    if (defined('SEND_TO_SMS') && is_array(SEND_TO_SMS) && count(SEND_TO_SMS) > 0) {
        try {
            $smsText = tkg_sms_sanitize($smsBody);

            // Gateways truncate; keep it sane
            if (strlen($smsText) > 600) {
                $smsText = substr($smsText, 0, 600) . '...';
            }

            $mail = tkg_mailer();
            $mail->setFrom(CONTACT_EMAIL, 'TKG Alerts');
            $mail->addReplyTo($replyToEmail, $replyToName);

            $mail->isHTML(false);
            $mail->Subject = ''; // ignored by most gateways
            $mail->Body    = $smsText;

            foreach (SEND_TO_SMS as $r) {
                $r = trim((string)$r);
                if ($r !== '') $mail->addAddress($r);
            }

            $mail->send();
            $result['sms'] = true;
        } catch (Exception $e) {
            error_log("TKG notify SMS gateway failed: " . $e->getMessage());
        }
    }

    return $result;
}