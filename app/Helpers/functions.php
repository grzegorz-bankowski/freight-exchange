<?php

function abort($code = 404)
{
    http_response_code($code);
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
