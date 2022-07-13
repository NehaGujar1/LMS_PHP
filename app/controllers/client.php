<?php

namespace Controller;
class Client{

public function get() {
        session_destroy();
        require __DIR__."./../views/templates/client.twig";
    }
    public function post() {
        if(isset($_POST["client_login_in"])) {
            header("Location: /client_log");
            exit();

        }
        else if(isset($_POST["client_registration_in"])) {
            header("Location: /client_reg");
            exit();
        }
        else {
            header("Location: /");
            exit();
        }
    }
}