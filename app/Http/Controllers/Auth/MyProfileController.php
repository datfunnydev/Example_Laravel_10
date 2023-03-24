<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MyProfileRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    private UserRepository $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index(): View
    {
        return view('auth.profile');
    }

    public function update(MyProfileRequest $request): JsonResponse
    {
        $input = $request->all();
        if (array_key_exists('avatar', $input)) {
            $response = $this->move_file(Auth::user()->avatar, Auth::id(), storage_path('app/public/images/avatars/'), $input['avatar']);
            $response = $this->json2array($response)['original'];
            if (! $response['status']) {
                return $this->error($response['message']);
            }
            $input['avatar'] = $response['message'];
        }
        $this->user->update(Auth::id(), $input);

        return $this->question('Bạn có muốn tải lại trang để hiển thị dữ liệu mới không?');
    }
}
