<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailTeste extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {
        //
    }

    public function build()
    {
      //  return $this->view('emailteste');
      return $this->subject('Assunto do nosso email')->view('emailteste');
    }
}
