<?php

namespace Controller;
class Admin{

public function get() {
        // echo "Hello";
        // echo __DIR__;
        require __DIR__."./../views/templates/admin.twig";
    }
    public function post() {
        // echo "hiii";
        $admin_login = $_POST["admin_login_in"];
        $admin_reg = $_POST["admin_registration_in"];
        // echo "hello";
        // echo $client_login;
        // echo $client_reg;
        if($admin_login==admin_login) {
            // echo "hi1";
            //redirect("/Client");
             require __DIR__."./../views/templates/admin_log.twig";

        }
        else if($admin_reg==admin_registration) {
            // echo "hi2";
             require __DIR__."./../views/templates/admin_reg.twig";
        }
    }
}