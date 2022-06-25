<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailReminder extends Mailable
{
    use Queueable, SerializesModels;
    protected $organizer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->markdown('mail.reminder')->with(['organizer' => $this->organizer]);
    }
}
