<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Alert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $amount;
    
    public function __construct($user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject(config('app.name'). ' - Payment Notification')
        ->from('support@instantnaire.com')
        ->markdown('Email.payment')
        ->with('data', $this->user, $this->amount);
    }
}