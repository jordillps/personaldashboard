<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    private $user_name;
    private $user_email;

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
        //return $this->view('mail.NewUserRegistered');
        return $this->subject(__("Nuevo usuario registrado en la aplicación"))
	        ->markdown('mail.NewUserRegistered') //template que utilitzara
	        ->with([
                'user_name' => $this->user_name,
                'user_email' => $this->user_email,
            ]);
    }
}
