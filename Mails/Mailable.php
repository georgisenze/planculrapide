<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require("Constant.php");

/**
 *
 */
class Mailable
{
    protected $send_to;

    function __construct()
    {

    }

    public function send()
    {
        $mail = new PHPMailer(Constant::MAIL_ENABLE_EXCEPTIONS);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     // Enable verbose debug output
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                     // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = Constant::MAIL_HOST;                  // Set the SMTP server to send through
            $mail->SMTPAuth   = Constant::MAIL_SMTP_AUTH;                                   // Enable SMTP authentication
            $mail->Username   = Constant::MAIL_USERNAME;                     // SMTP username
            $mail->Password   = Constant::MAIL_PASSWORD;                               // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable SSL encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = Constant::MAIL_PORT;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            //Recipients
            $mail->setFrom(Constant::MAIL_FROM);
            $mail->addAddress($this->send_to);     // Add a recipient
            $mail->addReplyTo(Constant::MAIL_REPLY_TO);

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->subject();
            $mail->Body    = $this->body();
            $mail->AltBody = $this->altBody();

            $mail->send();
            //echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    protected function body()
    {
        return 'This is the HTML message body <b>in bold!</b>';
    }

    protected function subject()
    {
        return 'Here is the subject';
    }

    protected function altBody()
    {
        return 'This is the body in plain text for non-HTML mail clients';
    }
}
