<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePassRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    private UserRepository $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index(): View
    {
        return view('auth.change_pass');
    }

    public function update(ChangePassRequest $request): JsonResponse
    {
        $input = $request->all();
        if (isset(Auth::user()->password) && ! Hash::check($input['old_password'], Auth::user()->password)) {
            return $this->error('Vui lòng kiểm tra lại mật khẩu cũ');
        }
        $this->user->update(Auth::id(), [
            'password' => bcrypt($input['password']),
        ]);

        return $this->success('Đổi mật khẩu thành công');
    }
}
