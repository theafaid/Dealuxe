<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $grandTotal;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $grandTotal)
    {
        $this->order = $order;
        $this->grandTotal = $grandTotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('front.order_created_mail_subject'))
            ->markdown('mails.order_created')
            ->with('order', $this->order->load(['user', 'products']))
            ->with('grandTotal', $this->grandTotal);
    }
}
