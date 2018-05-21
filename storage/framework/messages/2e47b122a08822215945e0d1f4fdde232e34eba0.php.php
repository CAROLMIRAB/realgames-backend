<?php

if (!function_exists('active')) {
    /**
     * Active the current menu
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function active($route)
    {
        if (!is_null($route)) {
            if (route($route) == \Request::url()) {
                return 'active open';
            }
        }
        return $route;
    }
}
