<?php

namespace Controller;

class AnyDataPg
{
    public static function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/any_data_pg.twig";
    }
    
    public static function post()
    {
        if (isset($_POST["end"])) {
            header("Location:/");
            exit();
        }
    }
}
