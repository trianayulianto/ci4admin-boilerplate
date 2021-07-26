<?php

namespace Config;

use Artesaos\Defender\Middlewares\NeedsPermissionMiddleware;
use Artesaos\Defender\Middlewares\NeedsRoleMiddleware;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use Fluent\Auth\Http\Middleware\AuthenticationFilter;
use Fluent\Auth\Http\Middleware\EnsureEmailIsVerifiedFilter;
use Fluent\Auth\Http\Middleware\RedirectAuthenticatedFilter;
use Fluent\Auth\Http\Middleware\ThrottleFilter;
use Fluent\JWTAuth\Http\Middleware\RefreshTokenFilter;
use Fluent\Laraci\Filters\PaginationFilter;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     	  => CSRF::class,
		'toolbar'  	  => DebugToolbar::class,
		'honeypot'	  => Honeypot::class,
		'paginate' 	  => PaginationFilter::class,
		'throttle' 	  => ThrottleFilter::class,
		'guest'    	  => RedirectAuthenticatedFilter::class,
		'auth'	   	  => AuthenticationFilter::class,
		'verified' 	  => EnsureEmailIsVerifiedFilter::class,
		'refresh'  	  => RefreshTokenFilter::class,
		'role'    	  => NeedsRoleMiddleware::class,
		'permission'  => NeedsPermissionMiddleware::class
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'csrf',
			// 'honeypot',
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [
		'get'	=> ['paginate'],
		// 'post'  => ['throttle']
	];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [
		'guest' => [
			'before' => [
				'/login',
				'/register',
				'/password/*'
			],
		],
		'auth' => [
			'before' => [
				'/email/verify',
				'/email/resend',
				'/logout'
			]
		]
	];
}
