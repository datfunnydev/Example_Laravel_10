<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    private UserRepository $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function reset_pass(ResetPasswordRequest $request): JsonResponse
    {
        $input = $request->all();
        $query = $this->user->query()->where('email', $input['email'])->where('token_reset', $input['token_reset'])->first();
        if ($query) {
            return $this->error('Mã xác nhận để mấy lại mật khẩu của bạn không đúng');
        }
        $query->update([
            'password' => bcrypt($input['password']),
            'token_reset' => Str::random(),
        ]);

        return $this->success('Đổi mật khẩu thành công');
    }
}
