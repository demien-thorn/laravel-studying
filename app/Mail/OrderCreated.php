<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\Pure;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected string|array $name;
    protected Order $order;

    /**
     * OrderCreated constructor.
     * @param array|string $name
     * @param Order $order
     */
    public function __construct(array|string $name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
    }


    /**
     * Get the message envelope.
     *
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Congrats! Your order has been created.',
        );
    }

    /**
     * Get the message content definition.
     *
     */
    #[Pure] public function content()
    {
        $fullSum = $this->order->getFullSum();
        return new Content(
            view: 'mail.order_created',
            with: [
                'name' => $this->name,
                'fullSum' => $fullSum,
                'order' => $this->order
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
