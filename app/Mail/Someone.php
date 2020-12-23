<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\One;

class Someone extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\One
     */
    public $one;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(One $one)
    {
        $this->one = $one;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$data = $this->one->toArray();
        $data['url'] = 'www.baidu.com';
        return $this->markdown('email.someone', $data)->subject('新的上墙申请');
    }
}
