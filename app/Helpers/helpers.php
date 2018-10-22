<?php

if (!function_exists('is_api_request')) {
    function is_api_request(\Illuminate\Http\Request $request = null)
    {
        if (app()->runningInConsole()) return false;

        if (is_null($request)) $request = request();

        return in_array('api', $request->route()->middleware());
    }
}