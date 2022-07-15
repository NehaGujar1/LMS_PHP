<?php

namespace Controller;

class LogOut
{
    public static function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/log_out.twig";
    }
    
    public static function post()
    {
        session_destroy();
    }
}
