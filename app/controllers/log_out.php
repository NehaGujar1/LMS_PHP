<?php

namespace Controller;

class LogOut {
    public static function get() {
        session_destroy();
        require __DIR__."./../views/templates/log_out.twig";
        // header("Location: /log_out");
        //     exit();
    }
    public static function post(){
        session_destroy();
    }
}