<?php

namespace Controller;

class AdminApp
{
    public function get()
    {
        session_start();
        if ($_SESSION["logged_ad"] == true) {
            echo \View\Loader::make()->render("admin_reg_app.twig", array(
                "regs" => \Model\Post::getAllReg(),
            ));
        } 
        else require __DIR__ . "./../views/templates/home.twig";
    }
    
    public function post()
    {
        session_start();
        if (isset($_POST["end"])) {
            $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
        } 
        else {
            if (isset($_POST["admin_reg_app"])) {
                $approval = $_POST["admin_reg_app"];
                \Model\Post::RegApproval($approval);
                echo \View\Loader::make()->render("admin_reg_app.twig", array(
                    "regs" => \Model\Post::getAllReg(),
                    "approved" => true,
                ));
            }
            if (isset($_POST["admin_reg_app_d"])) {
                $disapproval = $_POST["admin_reg_app_d"];
                \Model\Post::RegDisapproval($disapproval);
                echo \View\Loader::make()->render("admin_reg_app.twig", array(
                    "regs" => \Model\Post::getAllReg(),
                    "disapproved" => true,
                ));
            }
        }
    }
}
