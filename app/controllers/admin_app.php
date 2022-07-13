<?php

namespace Controller;

class AdminApp{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("admin_reg_app.twig", array(
            "regs" => \Model\Post::get_all_reg(),
        ));
    }
    else require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        session_start();
       if(isset($_POST["end"])){
           $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
       }
       else {
        if(isset($_POST["admin_reg_app"])) {
            $array = $_POST["admin_reg_app"];
        \Model\Post::reg_approval($array);
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 "regs" => \Model\Post::get_all_reg(),
                 "approved" => true,
             ));
       }
       if(isset($_POST["admin_reg_app_d"])){
        $array3 = $_POST["admin_reg_app_d"];
        \Model\Post::reg_disapproval($array3);
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 "regs" => \Model\Post::get_all_reg(),
                 "disapproved" => true,
             ));
       }
    }
    }
}