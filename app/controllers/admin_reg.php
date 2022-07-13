<?php

namespace Controller;

class AdminReg {
    public function get() {
        session_destroy();
        require __DIR__."./../views/templates/admin_reg.twig";
    }
    public function post() {
        if(isset($_POST["name"])) $name = $_POST["name"];
        if(isset($_POST["password"])) $password = $_POST["password"];
        if(isset($_POST["confirm_password"])) $confirm_password = $_POST["confirm_password"];
        $role = 'user';
        if(isset($_POST["name"])){
        $res =  \Model\Post::check($name,'admin');
        if(isset($_POST["password"])&&isset($_POST["confirm_password"])){
        if($res==null && $password==$confirm_password){
            session_start();
            $_SESSION["username"] = $name;
            $_SESSION["role"] = 'admin';
            $_SESSION["reg_ad"] = true;
            $_SESSION["reg_cl"] = false;
            $_SESSION["logged_cl"] = false;
            $_SESSION["logged_ad"] = false;
            \Model\Post::insert_admin_reg($name,$password,$role);
            require __DIR__."./../views/templates/admin_reg_page.twig" ;
        }
        elseif($res==null && $password!=$confirm_password){
            echo \View\Loader::make()->render("any_data_pg.twig", array(
                "variable" => "Passwords don't match",
            ));
        }
        else{
            echo \View\Loader::make()->render("any_data_pg.twig", array(
                "variable" => "Already registered",
            ));
        }
    }
    else{
        echo \View\Loader::make()->render("any_data_pg.twig", array(
            "variable" => "Incorrect credentials",
        ));
    }
    }
    else{
        echo \View\Loader::make()->render("any_data_pg.twig", array(
            "variable" => "Incorrect credentials",
        ));
    }
    }
}