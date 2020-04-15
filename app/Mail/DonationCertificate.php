<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationCertificate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                'partner_name' => $this->partner_name,
                'partner_email' => $this->partnet_email,
            ]);
    }
}
