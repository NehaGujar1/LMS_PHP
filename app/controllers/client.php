<?php

namespace Controller;
class Client{

public function get() {
        // echo "Hello";
        // echo __DIR__;
        require __DIR__."./../views/templates/client.twig";
    }
    public function post() {
        // echo "hiii";
        $client_login = $_POST["client_login_in"];
        $client_reg = $_POST["client_registration_in"];
        // echo "hello";
        // echo $client_login;
        // echo $client_reg;
        if($client_login=='Client Login') {
            // echo "hi1";
            //redirect("/Client");
             require __DIR__."./../views/templates/client_log.twig";

        }
        else if($client_reg=='Client Registration') {
            // echo "hi2";
             require __DIR__."./../views/templates/client_reg.twig";
        }
    }
}