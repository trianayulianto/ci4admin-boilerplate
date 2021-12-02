<?php

use Fluent\Auth\Facades\Auth;

$routes->get('/', 'HomeController::index', ['as' => 'homepage']);

Auth::routes();

$routes->group('administrator', ['filter' => 'verified'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard.index']);

    $routes->get('profile', 'ProfileController::index', ['as' => 'profile.index']);
    $routes->put('profile', 'ProfileController::update', ['as' => 'profile.update']);

    // User crud routes
    $routes->group('users', ['filter' => 'role:*'], function ($routes) {
	    $routes->get('/', 'UserController::index', ['as' => 'users.index', 'filter' => 'permission:account.users.index']);
	    $routes->get('data', 'UserController::getData', ['as' => 'users.data', 'filter' => 'permission:account.users.index']);
	    $routes->post('/', 'UserController::store', ['as' => 'users.create', 'filter' => 'permission:account.users.create']);
	    $routes->put('(:any)/update', 'UserController::store/$1', ['as' => 'users.update', 'filter' => 'permission:account.users.update']);
	    $routes->delete('(:any)/delete', 'UserController::destroy/$1', ['as' => 'users.delete', 'filter' => 'permission:account.users.delete']);

        // User role & permission assignment
        $routes->get('(:any)/show', 'UserController::show/$1', ['as' => 'users.show', 'filter' => 'permission:account.users.assign']);
        $routes->put('(:any)/permission', 'UserController::assign/$1', ['as' => 'users.assign', 'filter' => 'permission:account.users.assign']);
	});

    // Role crud routes
    $routes->group('roles', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'RoleController::index', ['as' => 'roles.index', 'filter' => 'permission:access.roles.index']);
        $routes->get('data', 'RoleController::getData', ['as' => 'roles.data', 'filter' => 'permission:access.roles.index']);
        $routes->post('/', 'RoleController::store', ['as' => 'roles.create', 'filter' => 'permission:access.roles.create']);
        $routes->put('(:any)/update', 'RoleController::store/$1', ['as' => 'roles.update', 'filter' => 'permission:access.roles.update']);
        $routes->delete('(:any)/delete', 'RoleController::destroy/$1', ['as' => 'roles.delete', 'filter' => 'permission:access.roles.delete']);

        // Role permission assignment
        $routes->get('(:any)/show', 'RoleController::show/$1', ['as' => 'roles.show', 'filter' => 'permission:access.roles.assign']);
        $routes->put('(:any)/permission', 'RoleController::assign/$1', ['as' => 'roles.assign', 'filter' => 'permission:access.roles.assign']);
    });

    // Role crud routes
    $routes->group('permissions', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'PermissionController::index', ['as' => 'permissions.index', 'filter' => 'permission:access.permissions.index']);
        $routes->get('data', 'PermissionController::getData', ['as' => 'permissions.data', 'filter' => 'permission:access.permissions.index']);
        $routes->post('/', 'PermissionController::store', ['as' => 'permissions.create', 'filter' => 'permission:access.permissions.create']);
        $routes->put('(:any)/update', 'PermissionController::store/$1', ['as' => 'permissions.update', 'filter' => 'permission:access.permissions.update']);
        $routes->delete('(:any)/delete', 'PermissionController::destroy/$1', ['as' => 'permissions.delete', 'filter' => 'permission:access.permissions.delete']);
    });

    // User Logs routes
    $routes->group('activity', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'UserLogableController::index', ['as' => 'activity.index', 'filter' => 'permission:system.activity.index']);
        $routes->get('data', 'UserLogableController::getData', ['as' => 'activity.data', 'filter' => 'permission:system.activity.index']);
        $routes->delete('clear', 'UserLogableController::destroy', ['as' => 'activity.clear', 'filter' => 'permission:system.activity.delete']);
    });
});
