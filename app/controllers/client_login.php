<?php

namespace Controller;

class ClientLog
{
    public function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/client_log.twig";
    }

    public function post()
    {
        if (isset($_POST["name"])) 
            $name = $_POST["name"];
        if (isset($_POST["password"])) 
            $password = $_POST["password"];
        $role = 'user';
        if (isset($_POST["password"]) && isset($_POST["name"])) {
            $salt =  \Model\Post::checkReg($name, 'user');
            $password = $salt + $password;
            $hash = hash('sha256', $password);
            $res = \Model\Post::checkRegPost($name, $hash, $role);
            if ($res != null) {
                session_start();
                $_SESSION["username"] = $name;
                $_SESSION["role"] = 'user';
                $_SESSION["logged_cl"] = true;
                $_SESSION["reg_cl"] = false;
                $_SESSION["reg_ad"] = false;
                $_SESSION["logged_ad"] = false;
                echo \View\Loader::make()->render("client_log_page.twig", array(
                    "sp" => \Model\Post::getAllSp($name),
                    "ur" => \Model\Post::urBk($name),
                    "name" => $name,
                    "var" => \Model\Post::feesFound($name),
                ));
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
