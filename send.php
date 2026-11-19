<?php
/**
 * Contact form handler for the static BookYap site.
 * Replaces Contact Form 7 (which needed WordPress). Uses PHP mail().
 *
 * TODO: set $to to the address that should receive contact messages
 * (no email address is published on the site). Until it is set, the form
 * shows its error message instead of sending.
 */

$to       = ''; // e.g. 'you@example.com'
$fromAddr = 'no-reply@bookyap.com';
$return   = 'contact/';
function back($return, $ok) { header('Location: ' . $return . '?sent=' . ($ok ? '1' : '0')); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . $return); exit; }

// Spam traps: our hidden honeypot and Akismet's hidden textarea (real visitors never fill them).
if (!empty($_POST['website_url']) || !empty($_POST['_wpcf7_ak_hp_textarea'])) back($return, true);

function clean_line($v) { return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', (string)$v)); }

$name    = clean_line($_POST['your-name'] ?? '');
$email   = clean_line($_POST['your-email'] ?? '');
$subject = clean_line($_POST['your-subject'] ?? '');
$message = trim((string)($_POST['your-message'] ?? ''));

if ($to === '' || $name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) back($return, false);

$body  = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}\n\n--\nSent from the contact form on bookyap.com";
$headers  = "From: BookYap Website <{$fromAddr}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = mail($to, 'Website contact: ' . ($subject !== '' ? $subject : 'New message'), $body, $headers, '-f' . $fromAddr);
back($return, $ok);
