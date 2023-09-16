<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class PHPMailerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $emailMessage;

    /**
     * Create a new emailMessage instance.
     *
     * @param  string  $subject
     * @param  string  $emailMessage
     * @return void
     */
    public function __construct($subject, $emailMessage)
    {
        $this->subject = $subject;
        $this->emailMessage = $emailMessage;
    }

    /**
     * Build the emailMessage.
     *
     * @return $this
     */
    public function build()
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = config('mail.mailers.smtp.host');
            $mail->Username = config('mail.mailers.smtp.username');
            $mail->Password = config('mail.mailers.smtp.password');
            $mail->SMTPSecure = config('mail.mailers.smtp.encryption');
            $mail->Port = config('mail.mailers.smtp.port');

            // Recipients
            $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
            $mail->addAddress($this->to[0]['address'], $this->to[0]['name']);

            // Content
            $mail->Subject = $this->subject;
            $mail->Body = $this->emailMessage;

            // $mail->send(); //comment if want to use email template
            
        } catch (Exception $e) {
            // Handle exception
            dd($e->getMessage());
        }
        // return $this;
        return $this->view('emails.phpmailer_email');
    }
}