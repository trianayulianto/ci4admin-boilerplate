<?php

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/

use Fluent\Laraci\Config\Services;
use eftec\bladeone\BladeOne as Blade;
use CodeIgniter\I18n\Time;

if (!function_exists('request')) {
    function request()
    {
        return \Config\Services::request();
    }
}

/**
 * Blade's view render.
 */
if (!function_exists('render')) {

    function render($view, $data = [])
    {
        $blade = Services::getSharedInstance('render');

        if (auth()->check()) {
            $auth = auth()->user();

            $blade->setAuth($auth->name);
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
 * Time parser.
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
