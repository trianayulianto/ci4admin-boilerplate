<?php

if (!function_exists('request')) {
    function request()
    {
        return \Config\Services::request();
    }
}