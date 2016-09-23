<?php

namespace L5Starter\PermissionManager\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use L5Starter\PermissionManager\Http\Requests\CreateRoleRequest;
use L5Starter\PermissionManager\Http\Requests\UpdateRoleRequest;
use L5Starter\PermissionManager\Repositories\PermissionRepository;
use L5Starter\PermissionManager\Repositories\RoleRepository;
use Response;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the Role.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate(config('settings.resultsPerPage'));

        return view('roles::index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles::create')->with([
            'permissions' => $this->permissionRepository->all(),
        ]);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create([
            'name' => $input['name'],
        ]);

        foreach ($input['permissions'] as $permission) {
            $role->permissions()->attach($permission);
        }

        \Flash::success(trans('l5starter::messages.create.success'));

        return redirect(route('admin.roles.index'));
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            \Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.roles.index'));
        }

        return view('roles::edit')->with([
            'permissions' => $this->permissionRepository->all(),
            'role' => $role,
        ]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            \Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.roles.index'));
        }

        $input = $request->all();

        $role = $this->roleRepository->update([
            'name' => $input['name'],
        ], $id);

        $permissions = [];
        foreach ($input['permissions'] as $permission) {
            $permissions[$permission] = $permission;
        }

        $role->permissions()->sync($permissions);

        \Flash::success(trans('l5starter::messages.update.success'));

        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            \Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.roles.index'));
        }

        $this->roleRepository->delete($id);

        \Flash::success(trans('l5starter::messages.delete.success'));

        return redirect(route('admin.roles.index'));
    }
}