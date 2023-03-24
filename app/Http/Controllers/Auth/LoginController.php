<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LoginController extends Controller
{
    private UserRepository $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/roles');
        }

        return view('layout.auth');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $input = $request->all();
        if (! Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $query = $this->user->exitsColumn('email', $input['email']);
            if (! $query) {
                return $this->error('Vui lòng kiểm tra lại tài khoản');
            }

            return $this->error('Vui lòng kiểm tra lại mật khẩu');
        }
        $this->user->update(Auth::id(), ['last_login_at' => Carbon::now()]);

        return $this->success(data: '/');
    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
