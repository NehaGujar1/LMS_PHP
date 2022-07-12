<?php

namespace Controller;

class Admin_log {
    public function get() {
        // echo "Hello";
        // echo __DIR__;
        session_destroy();
        require __DIR__."./../views/templates/admin_log.twig";
    }
    public function post() {
        //echo "hii";
         
        $name = $_POST["name"];
        $password = $_POST["password"];
        $role = 'admin';
        // echo \View\Loader::make()->render("templates/post.twig", array(
        //     "post" => \Model\Post::find($id),
        // ));
        //echo "hello";
        $res =  \Model\Post::check_2($name,$password,'admin');
        //echo "hih";
        if($res!=null){
            //echo "hehehe";
            session_start();
            $_SESSION["username"] = $name;
            $_SESSION["role"] = 'admin';
            require __DIR__."./../views/templates/admin_log_page.twig" ;
        }
        else{
            echo \View\Loader::make()->render("a.twig", array(
                "variable" => "Incorrect credentials",
            ));
        }
    }
}
