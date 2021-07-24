<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/

use eftec\bladeone\BladeOne as Blade;
use CodeIgniter\I18n\Time;

/**
 * Blade's view render.
 */
if (!function_exists('render')) {

    function render($view, $data = [])
    {
        helper('request', 'time');

        $path = APPPATH .'Views';
        $cache = WRITEPATH .'cache';

        $blade = new Blade($path, $cache, Blade::MODE_AUTO);

        if (auth()->check()) {
            $auth = auth()->user();

            $blade->setAuth(
                $auth->name,
                $auth->role ?? null,
                $auth->permission ?? []
            );
        }

        return $blade->run($view, $data);
    }

}

/**
 * view render for eloquent pagination
 */
if (!function_exists('paginator')) {
    function paginator($data, $view = 'partials.pagination')
    {
        $window = \Illuminate\Pagination\UrlWindow::make($data);
        
        $elements = [
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ];
        
        return render($view, [
            'paginator' => $data, 
            'elements'  => array_filter($elements)
        ]);
    }
}

/**
 * Dump variable.
 */
if ( ! function_exists('time_parser') ) {
    
    function timeParser($value) {
        return Time::parse($value, 'Asia/Jakarta');
    }

}

/**
 * Dump variable.
 */
if ( ! function_exists('d') ) {
    
    function d() {
        call_user_func_array( 'dump' , func_get_args() );
    }

}

/**
 * Dump variables and die.
 */
if ( ! function_exists('dd') ) {

    function dd() {
        call_user_func_array( 'dump' , func_get_args() );
        die();
    }

}
