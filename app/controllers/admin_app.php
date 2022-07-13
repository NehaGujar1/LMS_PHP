<?php

namespace Controller;

class AdminApp{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("admin_reg_app.twig", array(
            "regs" => \Model\Post::GetAllReg(),
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
        \Model\Post::RegApproval($array);
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 "regs" => \Model\Post::GetAllReg(),
                 "approved" => true,
             ));
       }
       if(isset($_POST["admin_reg_app_d"])){
        $array3 = $_POST["admin_reg_app_d"];
        \Model\Post::RegDisapproval($array3);
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 "regs" => \Model\Post::GetAllReg(),
                 "disapproved" => true,
             ));
       }
    }
    }
}