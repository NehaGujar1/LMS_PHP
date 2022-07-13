<?php

namespace Controller;
class Admin{

public function get() {
        session_destroy();
        require __DIR__."./../views/templates/admin.twig";
    }
    public function post() {
        if(isset($_POST["admin_login_in"])) {
             header("Location: /admin_log");
            exit();

        }
        else if(isset($_POST["admin_registration_in"])) {
             header("Location: /admin_reg");
            exit();
        }
        else {
            header("Location: /");
            exit();
        }
    }
}