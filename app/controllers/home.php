<?php

namespace Controller;

class Home
{
    public function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/home2.twig";
    }

    public function post()
    {
        if (isset($_POST["admin_in"])) {
            $admin = $_POST["admin_in"];
            header("Location: /admin");
            exit();
        } 
        else {
            $client = $_POST["client_in"];
            header("Location: /client");
            exit();
        }
    }
}
