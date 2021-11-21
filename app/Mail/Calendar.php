<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Calendar extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cals;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cals)
    {
        $this->user = $user;
        $this->cals = $cals;
        
       
        //dd($data);
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.niania_corp.calendar')
        ->subject('Twój aktualny grafik opieki');
    }
}
