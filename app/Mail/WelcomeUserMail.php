<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeUserMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->onQueue('VerifyEmailMail');
        $this->data = $data;
    }

    public function handle()
    {
        $email = $this->data['email'];
        $title = __('Chào mừng bạn đến với').' '.$this->data['store_name'];
        Mail::send('mail.welcome_user', ['res' => $this->data], function ($message) use ($title, $email) {
            $message->to($email)->subject($title);
            $message->from($email, config('app.name'));
        });
    }
}
