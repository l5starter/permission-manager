<?php

Route::group(['namespace' => 'L5Starter\PermissionManager\Http\Controllers\Admin', 'middleware' => ['web', 'auth']], function () {
    // Permissions
    Route::get('admin/permissions', ['as' => 'admin.permissions.index', 'uses' => 'PermissionController@index']);
    Route::post('admin/permissions', ['as' => 'admin.permissions.store', 'uses' => 'PermissionController@store']);
    Route::get('admin/permissions/create', ['as' => 'admin.permissions.create', 'uses' => 'PermissionController@create']);
    Route::put('admin/permissions/{permissions}', ['as' => 'admin.permissions.update', 'uses' => 'PermissionController@update']);
    Route::patch('admin/permissions/{permissions}', ['as' => 'admin.permissions.update', 'uses' => 'PermissionController@update']);
    Route::delete('admin/permissions/{permissions}', ['as' => 'admin.permissions.destroy', 'uses' => 'PermissionController@destroy']);
    Route::get('admin/permissions/{permissions}/edit', ['as' => 'admin.permissions.edit', 'uses' => 'PermissionController@edit']);
    // Roles
    Route::get('admin/roles', ['as' => 'admin.roles.index', 'uses' => 'RoleController@index']);
    Route::post('admin/roles', ['as' => 'admin.roles.store', 'uses' => 'RoleController@store']);
    Route::get('admin/roles/create', ['as' => 'admin.roles.create', 'uses' => 'RoleController@create']);
    Route::put('admin/roles/{roles}', ['as' => 'admin.roles.update', 'uses' => 'RoleController@update']);
    Route::patch('admin/roles/{roles}', ['as' => 'admin.roles.update', 'uses' => 'RoleController@update']);
    Route::delete('admin/roles/{roles}', ['as' => 'admin.roles.destroy', 'uses' => 'RoleController@destroy']);
    Route::get('admin/roles/{roles}/edit', ['as' => 'admin.roles.edit', 'uses' => 'RoleController@edit']);
});
