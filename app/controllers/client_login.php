<?php

namespace Controller;

class Client_log {
    public function get() {
        session_destroy();
        // echo "Hello";
        // echo __DIR__;
        require __DIR__."./../views/templates/client_log.twig";
    }
    public function post() {
        //echo "hii";
        $name = $_POST["name"];
        $password = $_POST["password"];
        $role = 'client';
        // echo \View\Loader::make()->render("templates/post.twig", array(
        //     "post" => \Model\Post::find($id),
        // ));
        //echo "hello";
        $res =  \Model\Post::check_2($name,$password,'user');
        //echo "hih";
        if($res!=null){
            session_start();
            $_SESSION["username"] = $name;
            $_SESSION["role"] = 'user';
            //echo "hehehe";
            echo \View\Loader::make()->render("client_log_page.twig", array(
                "sp" => \Model\Post::get_all_sp(),
                "ur" => \Model\Post::ur_bk($name),
                "name" => $name,
                "var" => \Model\Post::fees_found($name),
            ));
            //echo "meeeeeeeee";
        }
        else{
            echo \View\Loader::make()->render("a.twig", array(
                "variable" => "Incorrect credentials",
            ));
        }
    }
}
