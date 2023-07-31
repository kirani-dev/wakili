<?php
$controller = \App\Http\Controllers\Admin\Permissiongroup\IndexController::class;
$controller1 = \App\Http\Controllers\Admin\Permissiongroup\PermissionGroupController::class;
Route::get('/',[$controller,'index']);
Route::post('/',[$controller,'storePermissionGroup']);
Route::post('remove/{user_id}',[$controller,'removeUser']);
Route::get('/list',[$controller,'listPermissionGroups']);
Route::get('/{permission_group_id}',[$controller,'viewPermissionGroup'])->where('permission_group_id','[0-9]+');
Route::delete('/delete/{permissiongroup}',[$controller,'destroyPermissionGroup']);


Route::post('update-permission/{permission_group_id}',[$controller1,'updatePermissions']);
Route::post('add-to-group/{permission_group_id}',[$controller1,'addUserToPermissionGroup']);
Route::get('users/list',[$controller1,'listUsersWithoutPermissions']);

