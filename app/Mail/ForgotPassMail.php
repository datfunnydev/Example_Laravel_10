<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ForgotPassMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $token = $this->data['token'];
        $email = $this->data['email'];
        $title = __('Lấy lại mật khẩu');
        Mail::send('mail.forgot_pass', [
            'token' => $token,
        ], function ($message) use ($title, $email) {
            $message->to($email)->subject($title);
            $message->from($email, config('app.name'));
        });
    }
}
