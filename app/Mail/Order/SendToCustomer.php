<?php

namespace App\Mail\Order;

use App\Models\Front\Checkout\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToCustomer extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    public $order;

    /**
     * @var array
     */
    public $checkout = [];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $checkout)
    {
        if ($checkout) {
            $this->checkout = $checkout;
        }

        $this->order = $order;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SelfCheckins - Reservation')
                    ->view('emails.order.send-to-customer');
    }
}
