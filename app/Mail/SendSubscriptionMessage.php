<?php

namespace App\Mail;

use App\Models\Sku;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\Pure;

class SendSubscriptionMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected Sku $sku;

    /**
     * SendSubscriptionMessage constructor.
     * @param Sku $sku
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Subscription Message',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    #[Pure] public function content()
    {
        return new Content(
            view: 'mail.subscription',
            with: ['sku' => $this->sku]
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
