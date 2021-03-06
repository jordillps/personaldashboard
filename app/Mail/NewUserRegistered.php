<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $user_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name,$user_email)
    {

        $this->user_name = $user_name;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //To see the email in the browser
        //return $this->view('mail.NewUserRegistered');

        return $this->subject(__("Nuevo usuario registrado en la aplicación"))
	        ->markdown('emails.NewUserRegistered') //template que utilitzara
	        ->with([
                'user_name' => $this->user_name,
                'user_email' => $this->user_email,
            ]);
    }
}
