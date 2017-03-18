<?php

namespace L5Starter\PermissionManager\Http\Controllers\Admin;

use L5Starter\PermissionManager\Http\Requests\CreatePermissionRequest;
use L5Starter\PermissionManager\Http\Requests\UpdatePermissionRequest;
use L5Starter\PermissionManager\Repositories\PermissionRepository;
use App\Http\Controllers\Controller;
use Flash;
use L5Starter\PermissionManager\Repositories\RoleRepository;
use Response;

class PermissionController extends Controller
{
    private $permissionRepository;
    private $roleRepository;

    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the Permission.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->permissionRepository->paginate(config('settings.resultsPerPage'));

        return view('permissions::index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions::create')->with([
            'roles' => $this->roleRepository->all(),
        ]);
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create([
            'name' => $input['name'],
        ]);

        foreach ($input['roles'] as $role) {
            $permission->roles()->attach($role);
        }

        Flash::success(trans('l5starter::messages.create.success'));

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.permissions.index'));
        }

        return view('permissions::edit')->with([
            'roles' => $this->roleRepository->all(),
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param  int $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.permissions.index'));
        }

        $input = $request->all();

        $permission = $this->permissionRepository->update([
            'name' => $input['name'],
        ], $id);

        $roles = [];

        if (!empty($input['roles'])) {
            foreach ($input['roles'] as $role) {
                $roles[$role] = $role;
            }
        }

        $permission->roles()->sync($roles);

        Flash::success(trans('l5starter::messages.update.success'));

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success(trans('l5starter::messages.delete.success'));

        return redirect(route('admin.permissions.index'));
    }
}
