<?php

namespace Config;

use App\Listeners\UserEventSubscriber;
use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', function () {
	if (ENVIRONMENT !== 'testing')
	{
		if (ini_get('zlib.output_compression'))
		{
			throw FrameworkException::forEnabledZlibOutputCompression();
		}

		while (ob_get_level() > 0)
		{
			ob_end_flush();
		}

		ob_start(function ($buffer) {
			return $buffer;
		});
	}

	/*
	 * --------------------------------------------------------------------
	 * Debug Toolbar Listeners.
	 * --------------------------------------------------------------------
	 * If you delete, they will no longer be collected.
	 */
	if (CI_DEBUG && ! is_cli())
	{
		Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
		Services::toolbar()->respond();
	}

});

Events::on('pre_system', function () {
	// boot auth library
	helper('auth');
	// boot defender library
	helper('defender');
	// boot laraci library
	helper('laraci');
});

Events::on('pre_system', [\Fluent\Laraci\EloquentServiceProvider::class, 'register']);

Events::on('pre_system', [\Artesaos\Defender\DefenderGuardServiceProvider::class, 'register']);

Events::on('login', function () {
	return (new UserEventSubscriber(auth('api')->user()))->handleUserLogin();
});

Events::on('logout', function () {
	return (new UserEventSubscriber(auth('api')->user()))->handleUserLogout();
});

Events::on(\Fluent\Auth\Contracts\VerifyEmailInterface::class, function ($email) {
    return (new \App\Notifications\VerificationNotification($email))->send();
});

Events::on(\Fluent\Auth\Contracts\ResetPasswordInterface::class, function ($email, $token) {
    return (new \App\Notifications\ResetPasswordNotification($email, $token))->send();
});
