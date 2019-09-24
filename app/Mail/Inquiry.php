<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $msg;
    public $name;
    public $phone_number;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject, $phone_number, $message)
    {
        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
        $this->phone_number = $phone_number;
        $this->msg = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to('escutonklein@gmail.com')
            ->from([ 
                'address' => "condoatmegaworld@gmail.com", 
                'name' => "Megaworld Properties"
            ])
            ->subject($this->subject)
            ->view('email.inquiry');
            //->with([
            //    'name' => "keme name",
            //    'phone_number' => "09109",
            //    'email' => "kemeng email",
            //    'message' => "kemeng message"
            //]);
    }
}
