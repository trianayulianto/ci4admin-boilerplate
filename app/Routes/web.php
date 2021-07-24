<?php

use Fluent\Auth\Facades\Auth;

$routes->get('/', 'HomeController::index', ['as' => 'homepage']);

Auth::routes();

$routes->group('administrator', ['filter' => 'verified'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard.index']);

    $routes->get('profile', 'ProfileController::index', ['as' => 'profile.index']);
    $routes->put('profile', 'ProfileController::update', ['as' => 'profile.update']);

    // User crud routes
    $routes->group('users', ['filter' => 'role:superuser'], function ($routes) {
	    $routes->get('/', 'UserController::index', ['as' => 'users.index']);
	    $routes->get('data', 'UserController::getData', ['as' => 'users.data']);
	    $routes->post('/', 'UserController::store', ['as' => 'users.create']);
	    $routes->put('(:any)/update', 'UserController::store/$1', ['as' => 'users.update']);
	    $routes->delete('(:any)/delete', 'UserController::destroy/$1', ['as' => 'users.delete']);

        // User role & permission assignment
        $routes->get('(:any)/show', 'UserController::show/$1', ['as' => 'users.show']);
        $routes->put('(:any)/permission', 'UserController::assign/$1', ['as' => 'users.assign']);
	});

    // Role crud routes
    $routes->group('roles', ['filter' => 'role:superuser'], function ($routes) {
        $routes->get('/', 'RoleController::index', ['as' => 'roles.index']);
        $routes->get('data', 'RoleController::getData', ['as' => 'roles.data']);
        $routes->post('/', 'RoleController::store', ['as' => 'roles.create']);
        $routes->put('(:any)/update', 'RoleController::store/$1', ['as' => 'roles.update']);
        $routes->delete('(:any)/delete', 'RoleController::destroy/$1', ['as' => 'roles.delete']);

        // Role permission assignment
        $routes->get('(:any)/show', 'RoleController::show/$1', ['as' => 'roles.show']);
        $routes->put('(:any)/permission', 'RoleController::assign/$1', ['as' => 'roles.assign']);
    });

    // Role crud routes
    $routes->group('permissions', ['filter' => 'role:superuser'], function ($routes) {
        $routes->get('/', 'PermissionController::index', ['as' => 'permissions.index']);
        $routes->get('data', 'PermissionController::getData', ['as' => 'permissions.data']);
        $routes->post('/', 'PermissionController::store', ['as' => 'permissions.create']);
        $routes->put('(:any)/update', 'PermissionController::store/$1', ['as' => 'permissions.update']);
        $routes->delete('(:any)/delete', 'PermissionController::destroy/$1', ['as' => 'permissions.delete']);
    });

    // User Logs routes
    $routes->group('activity', ['filter' => 'role:superuser'], function ($routes) {
        $routes->get('/', 'UserLogableController::index', ['as' => 'activity.index']);
        $routes->get('data', 'UserLogableController::getData', ['as' => 'activity.data']);
        $routes->delete('clear', 'UserLogableController::destroy', ['as' => 'activity.clear']);
    });
});
