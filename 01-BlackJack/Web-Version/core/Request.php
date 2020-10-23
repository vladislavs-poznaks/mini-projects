<?php

namespace Core;

class Request
{

    public static function uri(): string
    {
        return parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);
    }

    public static function type(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}