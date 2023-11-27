<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $webinfo)
    {
        $this->booking = $booking;
        $this->webinfo = $webinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking = $this->booking;
        $webinfo = $this->webinfo;
        return $this->subject('Restaurant Reservation')
                    ->markdown('frontend.mail.index')
                    ->with([
                        'book' => $booking,
                        'web_info' => $webinfo,
                    ]);
    }
}
