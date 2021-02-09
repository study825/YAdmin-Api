<?php

use App\Http\Controllers\Admin\ActiveLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([])->namespace('Home')->name('home.')->group(function () {
});

Route::middleware(['lang'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::middleware(['jwt.role:admin', 'jwt.auth'])->group(function () {
        Route::post('me', [LoginController::class, 'me']);
        Route::post('notifications', [NotificationController::class, 'notifications']);
        Route::post('notification', [NotificationController::class, 'notification']);
        Route::post('notification/unReadCount', [NotificationController::class, 'unReadCount']);
        Route::post('notification/allRead', [NotificationController::class, 'allRead']);
        Route::post('notification/read', [NotificationController::class, 'read']);
        Route::post('notification/admins', [NotificationController::class, 'admins']);
        Route::post('notification/send', [NotificationController::class, 'send']);
        Route::middleware(['auth:admin', 'auth.status:admin'])->group(function () {
            // 权限
            Route::post('permission/create', [PermissionController::class, 'create'])
                ->middleware('permission:permission.create');
            Route::post('permission/update', [PermissionController::class, 'update'])
                ->middleware('permission:permission.update');
            Route::post('permission/delete', [PermissionController::class, 'delete'])
                ->middleware('permission:permission.delete');
            Route::post('permission', [PermissionController::class, 'permission'])
                ->middleware('permission:permission.permission');
            Route::post('permissions', [PermissionController::class, 'permissions'])
                ->middleware('permission:permission.permissions');
            Route::post('permission/tree', [PermissionController::class, 'permissionsTree'])
                ->middleware('permission:permission.permissions');
            Route::post('permission/drop', [PermissionController::class, 'drop'])
                ->middleware('permission:permission.update');
            // 角色
            Route::post('role/create', [RoleController::class, 'create'])->middleware('permission:role.create');
            Route::post('role/update', [RoleController::class, 'update'])->middleware('permission:role.update');
            Route::post('role/delete', [RoleController::class, 'delete'])->middleware('permission:role.delete');
            Route::post('role/syncPermissions', [RoleController::class, 'syncPermissions'])
                ->middleware('permission:role.syncPermissions');
            Route::post('role/syncRoles', [RoleController::class, 'syncRoles'])
                ->middleware('permission:role.syncRoles');
            Route::post('role', [RoleController::class, 'role'])->middleware('permission:role.role');
            Route::post('roles', [RoleController::class, 'roles'])->middleware('permission:role.roles');
            Route::post('role/all', [RoleController::class, 'allRoles'])->middleware('permission:role.roles');
            // 管理员
            Route::post('admin/create', [AdminController::class, 'create'])->middleware('permission:admin.create');
            Route::post('admin/update', [AdminController::class, 'update'])->middleware('permission:admin.update');
            Route::post('admin/delete', [AdminController::class, 'delete'])->middleware('permission:admin.delete');
            Route::post('admin/syncPermissions', [AdminController::class, 'syncPermissions'])
                ->middleware('permission:admin.syncPermissions');
            Route::post('admin/updateSelf', [AdminController::class, 'updateSelf']);
            Route::post('admins', [AdminController::class, 'admins'])->middleware('permission:admin.admins');
            Route::post('admin', [AdminController::class, 'admin'])->middleware('permission:admin.admin');
            // 操作记录
            Route::post('active/logs', [ActiveLogController::class, 'logs'])
                ->middleware('permission:activeLog.activeLogs');
        });
    });
});

