<?php

class Gmail
{
    public static function sendMail($message)
    {
        $mail = Gmail::setup();
        $mail->setFrom('ss3cms@gmail.com', 'Crisis Management System');
        $mail->addAddress("xxlaguna93@gmail.com", "shadofren");
        $mail->Subject = "Crisis updates for the last 30 minutes";
        $mail->Body = $message;
        $mail->AltBody = "";
        if (!$mail->send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return "Message sent!";
        }
    }

    //this require php 5.5^
    private static function setup_oauth()
    {
        $mail = new PHPMailerOAuth; /* this must be the custom class we created */
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->AuthType = 'XOAUTH2';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->oauthUserEmail = 'YOUR_EMAIL@gmail.com';
        $mail->oauthClientId = "SOMETHING.apps.googleusercontent.com";
        $mail->oauthClientSecret = "#YOUR CLIENT SECRET#";
        $mail->oauthRefreshToken = "#YOUR REFRESH TOKEN#";
        return $mail;
    }

    private static function setup()
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "YOUR_EMAIL@gmail.com";
        $mail->Password = "#YOUR PASSWORD#";
        return $mail;
    }
}
