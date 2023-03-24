<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Create\CreateRoleRequest;
use App\Http\Requests\Admin\Update\UpdateRoleRequest;
use App\Jobs\CreateLogActivity;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    private RoleRepository $role;

    private PermissionRepository $permission;

    private UserRoleRepository $user_role;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository,
        UserRoleRepository $userRoleRepository,
    ) {
        $this->role = $roleRepository;
        $this->permission = $permissionRepository;
        $this->user_role = $userRoleRepository;
    }

    public function index(RoleDataTable $roleDataTable): mixed
    {
        return $roleDataTable->render('admin.role.index', [
            'permissions' => $this->permission->getByCategory(),
        ]);
    }

    public function store(CreateRoleRequest $request): JsonResponse
    {
        $input = $request->all();
        $query = $this->role->exitsColumn('name', $input['name']);
        if ($query) {
            return $this->error('Đã tồn tại chức vụ này rồi');
        }
        $query = $this->role->create($input);
        if ($query) {
            if ($this->valid($input['permission_id'])) {
                $query->permissions()->sync($input['permission_id']);
            }
            $activity = __('Tạo chức vụ ').' '.$input['name'];
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Tạo chức vụ thành công');
        }

        return $this->error();
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->role->query()->with('permissions')->findOrFail($id);
        if ($response) {
            return $this->success(data: $response);
        }

        return $this->error();
    }

    public function update(int $id, UpdateRoleRequest $request): JsonResponse
    {
        $input = $request->all();
        $query = $this->role->exitsKeyNot($id, 'name', $input['name']);
        if ($query) {
            return $this->error('Đã có chức vụ này rồi');
        }
        $query = $this->role->find($id);
        if ($query) {
            $query->update($input);
            if ($this->valid($input['permission_id'])) {
                $query->permissions()->sync($input['permission_id']);
            }
            $activity = __('Cập nhật chức vụ ID').' '.$id;
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Cập nhật chức vụ thành công');
        }

        return $this->error();
    }

    public function destroy(int $id): JsonResponse
    {
        $query = $this->user_role->exitsColumn('role_id', $id);
        if ($query) {
            return $this->error('Đang có nhân viên sử dụng chức vụ này');
        }
        $query = $this->role->delete($id);
        if ($query) {
            $activity = __('Xoá nhật chức vụ ID').' '.$id;
            $this->dispatch(new CreateLogActivity($activity));

            return $this->success('Xoá chức vụ thành công');
        }

        return $this->error();
    }
}
