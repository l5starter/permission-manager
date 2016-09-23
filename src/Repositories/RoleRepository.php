<?php

namespace L5Starter\PermissionManager\Repositories;

use L5Starter\Core\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Role::class;
    }
}
