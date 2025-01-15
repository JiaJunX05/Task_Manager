<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct($task, $messageContent)
    {
        $this->task = $task;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Task Reminder Mail')
                    ->view('emails.taskReminder') // Ensure this view file exists
                    ->with('messageContent', $this->messageContent);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Reminder Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // Removed this method since it's redundant for your use case

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}