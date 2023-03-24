<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeleteUserDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Create\CreateUserRequest;
use App\Http\Requests\Admin\Update\UpdateUserRequest;
use App\Jobs\CreateLogActivity;
use App\Mail\WelcomeUserMail;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private UserRepository $user;

    private RoleRepository $role;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
    ) {
        $this->user = $userRepository;
        $this->role = $roleRepository;
    }

    public function index(UserDataTable $userDataTable, DeleteUserDataTable $deletedUserDataTable, Request $request)
    {
        if ($request->input('type') == 'deleted') {
            return $deletedUserDataTable->render('admin.user.index');
        }

        return $userDataTable->render('admin.user.index', [
            'deletedUserDataTable' => $deletedUserDataTable->html(),
            'roles' => $this->role->getAll(),
        ]);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $password = Str::random(8);
        $input = $request->all();
        $input['password'] = bcrypt($password);
        $input['created_by'] = Auth::id();
        $query = $this->user->exitsColumn('email', $input['email']);
        if ($query) {
            return $this->error('Đã có tài khoản dùng email này rồi');
        }
        $query = $this->user->create($input);
        if ($query) {
            $query->roles()->sync($input['role_id']);
            $this->dispatch(new WelcomeUserMail([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $password,
                'created_by' => Auth::user()->name,
                'url' => url('/'),
            ]));
            $activity = __('Tạo tài khoản ').' '.$input['email'];
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Thêm nhân viên thành công');
        }

        return $this->error();
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->user->find($id);
        if ($response) {
            return $this->success(data: $response);
        }

        return $this->error();
    }

    public function update(int $id, UpdateUserRequest $request): JsonResponse
    {
        $input = $request->all();
        $query = $this->user->exitsKeyNot($id, 'email', $input['email']);
        if ($query) {
            return $this->error('Đã có tài khoản dùng email này rồi');
        }
        $query = $this->user->find($id);
        if ($query) {
            $query->update($input);
            $query->roles()->sync($input['role_id']);
            $activity = __('Cập nhật tài khoản ID').' '.$id;
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Cập nhật nhân viên thành công');
        }

        return $this->error();
    }

    public function destroy(int $id): JsonResponse
    {
        $query = $this->user->delete($id);
        if ($query) {
            $activity = __('Xoá tài khoản ID').' '.$id;
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Xoá nhân viên thành công');
        }

        return $this->error();
    }

    public function restore(int $id): JsonResponse
    {
        $query = $this->user->query()->withTrashed()->find($id);
        if ($query) {
            $query->restore();
            $activity = __('Khôi phục nhật tài khoản ID').' '.$id;
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Khôi phục nhân viên thành công');
        }

        return $this->error();
    }
}
