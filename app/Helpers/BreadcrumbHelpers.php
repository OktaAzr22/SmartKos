<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('generate_breadcrumb')) {
    function generate_breadcrumb()
    {
        $segments = Request::segments();
        $breadcrumb = [];
        $url = '';

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumb[ucfirst(str_replace('-', ' ', $segment))] = url($url);
        }

        return $breadcrumb;
    }
}
