<?php


namespace BtcRelax;
require 'vendor/autoload.php';
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailSendApi
{
    protected  $mail;


    function __construct()
    {
        $this->mail = new  PHPMailer(true);
    }

    public function sendMail() {
        /* Open the try/catch block. */
        try {
            /* Set the mail sender. */
            $this->mail->setFrom('darth@empire.com', 'Darth Vader');

            /* Add a recipient. */
            $this->mail->addAddress('palpatine@empire.com', 'Emperor');

            /* Set the subject. */
            $this->mail->Subject = 'Force';

            /* Set the mail message body. */
            $this->mail->Body = 'There is a great disturbance in the Force.';

            /* Finally send the mail. */
            $this->mail->send();
        }
        catch (Exception $e)
        {
            /* PHPMailer exception. */
            return $e->errorMessage();
        }
        catch (\Exception $e)
        {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            return $e->getMessage();
        }
    }
}