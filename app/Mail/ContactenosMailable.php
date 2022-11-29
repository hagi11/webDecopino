<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactenosMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "información de contacto";
    public $contacto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto)
    {
        $this->contacto = $contacto; 
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = $this->contacto['email'];
        $name = $this->contacto['name'];
        return $this->view('inf_general.informacionemail');
    }
}
