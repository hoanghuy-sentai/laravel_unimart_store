<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /**
     * Build the message.
     *
     * @return $this
     */
    public function __construct($data)
    {
        $this->data=$data;
    }
    public function build()
    {
        return $this->view('mail.payment')
                    ->from("tendangnhaptaiday@gmail.com",'ismart.vn')
                    ->subject('[ismart.vn] Thư xác nhận thanh toán')
                    ->with($this->data);
             
    }
}
