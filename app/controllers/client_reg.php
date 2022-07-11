<?php

namespace Controller;

class Client_reg {
    public function get() {
        // echo "Hello";
        // echo __DIR__;
        session_destroy();
        require __DIR__."./../views/templates/client_reg.twig";
    }
    public function post() {
        //echo "hii";
        $name = $_POST["name"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $role = 'user';
        // echo \View\Loader::make()->render("templates/post.twig", array(
        //     "post" => \Model\Post::find($id),
        // ));
        //echo "hello";
        $res =  \Model\Post::check($name,'user');
        //echo "hihihi";
        if($res==null && $password==$confirm_password){
            //echo "blahblahblah";
            session_start();
            $_SESSION["username"] = $name;
            $_SESSION["role"] = 'user';
            \Model\Post::insert($name,$password,$role);
            echo \View\Loader::make()->render("client_reg_page.twig", array(
                "sp" => \Model\Post::get_all_sp(),
                "name" => $name,
            ));
        }
        elseif($res==null && $password!=$confirm_password){
            echo "Passwords don't match";
        }
        else{
            echo "Already registered";
        }
    }
}