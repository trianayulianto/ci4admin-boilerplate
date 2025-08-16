<?php

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/

use CodeIgniter\I18n\Time;
use eftec\bladeone\BladeOne as Blade;
use Fluent\Laraci\Config\Services;

if (! function_exists('request')) {
    function request()
    {
        return \Config\Services::request();
    }
}

/**
 * Blade's view render.
 */
if (! function_exists('render')) {

    function render($view, $data = [])
    {
        $blade = Services::getSharedInstance('render');

        if (($auth = auth()->user())) {
            $blade->setAuth($auth->name);
        }

        return $blade->run($view, $data);
    }

}

/**
 * view render for eloquent pagination
 */
if (! function_exists('paginator')) {
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
            'elements' => array_filter($elements),
        ]);
    }
}

/**
 * Time parser.
 */
if (! function_exists('time_parser')) {

    function timeParser($value)
    {
        return Time::parse($value, 'Asia/Jakarta');
    }

}
