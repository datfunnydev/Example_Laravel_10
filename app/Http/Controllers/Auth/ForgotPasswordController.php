<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPassRequest;
use App\Mail\ForgotPassMail;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    private UserRepository $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index(): View
    {
        return view('auth.forgot_pass');
    }

    public function forgot_pass(ForgotPassRequest $request): JsonResponse
    {
        $input = $request->all();
        $query = $this->user->findColumn('email', $input['email']);
        if (! $query) {
            return $this->error('Không tìm thấy tài khoản này vui lòng kiểm tra lại');
        }
        $token_reset = Str::random();
        $query->update(['token_reset' => $token_reset]);
        $data = [
            'token_reset' => $token_reset,
            'email' => $input['email'],
        ];
        $this->dispatch(new ForgotPassMail($data));

        return $this->success('Đã gửi mã xác nhận để lấy lại mật khẩu về email của bạn');
    }
}
