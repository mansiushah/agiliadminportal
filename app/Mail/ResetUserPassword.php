<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
class ResetUserPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $otp;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $otp)
    {
        $this->name = $name;
        $this->otp = $otp;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification code',
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resentnewpassword', // Your Blade view file
            with: [
                'name' => $this->name,
                'otp' => $this->otp,
            ],
        );
    }
    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
