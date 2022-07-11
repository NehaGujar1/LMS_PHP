<?php

namespace Controller;

class Log_out {
    public static function get() {
        require __DIR__."./../views/templates/log_out.twig";
    }
    public static function post(){
        session_destroy();
    }
}