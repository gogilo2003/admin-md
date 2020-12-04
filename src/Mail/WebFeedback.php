<?php

namespace Ogilo\AdminMd\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WebFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public $data = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (object)$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->data);
        return $this->subject($this->data->subject ?? "Website Feedback")
                    ->from(["address"=>$this->data->email,"name"=>$this->data->name])
                    ->to(config('admin.contact'))
                    ->view('admin::emails.feedback');
    }
}
