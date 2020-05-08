<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Reservation;

class ReservationConfirmationAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        //
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservationconfirmationadmin')
        ->with([
            'name' => $this->reservation->name,
            'email' => $this->reservation->email,
            'phone' => $this->reservation->phone,
            'reservation_date' => $this->reservation->reservation_date,
            'slot' => $this->reservation->slot,
        ]);
    }
}
