<?php

namespace Controller;

class ClientReg
{
    public function get()
    {
        session_destroy();
        require __DIR__ . "./../views/templates/client_reg.twig";
    }

    public function post()
    {
        if (isset($_POST["name"])) $name = $_POST["name"];
        if (isset($_POST["password"])) $password = $_POST["password"];
        if (isset($_POST["confirm_password"])) $confirm_password = $_POST["confirm_password"];
        $role = 'user';
        if (isset($_POST["name"])) {
            $res =  \Model\Post::check($name, 'user');
            if ($res == null && $password == $confirm_password) {
                session_start();
                $_SESSION["username"] = $name;
                $_SESSION["role"] = 'user';
                $_SESSION["reg_cl"] = true;
                $_SESSION["logged_cl"] = false;
                $_SESSION["reg_ad"] = false;
                $_SESSION["logged_ad"] = false;
                srand(mktime());
                //To ensure that the randomised function does not repeat the same number
                $salt = (string)rand(1111111111, 9999999999);
                $password = $salt + $password;
                $hash = hash('sha256', $password);
                \Model\Post::insert($name, $password, $role, $salt, $hash);
                echo \View\Loader::make()->render("client_reg_page.twig", array(
                    "sp" => \Model\Post::getAllSp($name),
                    "name" => $name,
                ));
            } 
            elseif ($res == null && $password != $confirm_password) {
                echo \View\Loader::make()->render("any_data_pg.twig", array(
                    "variable" => "Passwords don't match",
                ));
            } 
            else {
                echo \View\Loader::make()->render("any_data_pg.twig", array(
                    "variable" => "Already registered",
                ));
            }
        }
    }
}
