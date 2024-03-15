<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2023-12-12
 */
class ShRexEmail
{
    /**
     * @throws Exception
     */
    public static function send($subject, $body, $to = null, $from = null, $fromName = null): void
    {
        /* konfigurieren in config.yml */

        if (!$to) {
            $to = rex::getProperty('contact_email_to');
        }
        if (!$from) {
            $from = rex::getProperty('contact_email_from');
        }
        if (!$fromName) {
            $fromName = rex::getProperty('contact_name_from');
        }
        /*
        if (!$replyTo) {
            $replyTo = rex::getProperty('contact_email');
        }
        if (!$replyToName) {
            $replyToName = rex::getProperty('contact_name');
        }
        */
        $mail = new rex_mailer();
        $mail->IsHTML(false);
        $mail->CharSet = 'utf-8';
        $mail->From = $from;
        $mail->FromName = $fromName;
        $mail->Sender = $from;
        // $mail->AddReplyTo($replyTo, $replyToName);
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->Send();
    }
}