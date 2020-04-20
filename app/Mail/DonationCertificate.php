<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationCertificate extends Mailable
{
    use Queueable, SerializesModels;

    private $receiver_name;
    private $receiver_email;

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
        //return $this->view('view.name');
        return $this->subject(__("Certificat de Donacions Angel Olaran"))
            ->markdown('mail.DonationCertificate') //template que utilitzara
            ->attachFromStorage('/path/to/file')
	        ->with([
                'receiver_name' => $this->receiver_name,
                'receiver_email' => $this->receiver_email,
            ]);
    }
}
