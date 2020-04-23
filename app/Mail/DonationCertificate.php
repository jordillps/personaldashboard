<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver_name;
    public $receiver_email;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiver_name,$receiver_email)
    {
        //
        $this->receiver_name = $receiver_name;
        $this->receiver_email = $receiver_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fileName = str_replace(' ', '', $this->receiver_name).'.'.'pdf';
        //return $this->view('view.name');
        return $this->subject(__("Certificat de Donacions Angel Olaran"))
            ->view('maileclipse::templates.emailConfirmation') //template que utilitzara
            ->attachFromStorage('/pdfs/'.$fileName)
	        ->with([
                'receiver_name' => $this->receiver_name,
                'receiver_email' => $this->receiver_email,
            ]);
    }
}




