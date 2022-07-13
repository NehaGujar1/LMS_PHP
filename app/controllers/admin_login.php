<?php

namespace Controller;

class AdminLog
{
    public function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/admin_log.twig";
    }

    public function post()
    {
        if (isset($_POST["name"])) $name = $_POST["name"];
        if (isset($_POST["password"])) $password = $_POST["password"];
        $role = 'admin';
        if (isset($_POST["name"]) && isset($_POST["password"])) {
            $salt =  \Model\Post::checkReg($name, 'admin');
            $password = $salt + $password;
            $hash = hash('sha256', $password);
            $res = \Model\Post::checkRegPost($name, $hash, $role);
            if ($res != null) {
                session_start();
                $_SESSION["username"] = $name;
                $_SESSION["role"] = 'admin';
                $_SESSION["logged_ad"] = true;
                $_SESSION["reg_cl"] = false;
                $_SESSION["logged_cl"] = false;
                $_SESSION["reg_ad"] = false;
                header("Location: /admin_log_page");
                exit();
            } 
            else {
                echo \View\Loader::make()->render("any_data_pg.twig", array(
                    "variable" => "Incorrect credentials",
                ));
            }
        } 
        else {
            echo \View\Loader::make()->render("any_data_pg.twig", array(
                "variable" => "Incorrect credentials",
            ));
        }
    }
}
