<?php

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function base_path($path)
{
    return PATH . $path;
}

function view($path)
{
    require base_path('views/' . $path);
}
