<?php

namespace Controller;

class ClientRegPg
{

    public function get($name)
    {
        session_start();
        if ($_SESSION["reg_cl"] == true) {
            echo \View\Loader::make()->render("client_reg_page.twig", array(
                "sp" => \Model\Post::getAllSp($name),
                "name" => $name,
            ));
        } 
        else require __DIR__ . "./../views/templates/home.twig";
    }

    public function post()
    {
        if (isset($_POST["Log_out"])) {
            header("Location: /");
            exit();
        } 
        else if ($_POST["end"]) {
            header("Location: /client_log");
            exit();
        } 
        else {
            $bk_name = $_POST["client_reg_pg"];
            $str_arr = explode(",--", $bk_name);
            $name = $str_arr[\Enum\constant::one];
            $isbn = $str_arr[\Enum\constant::zero];
            $res = \Model\Post::addCheckOutReq($name, $isbn);
            $qty_left = $res - 1;
            \Model\Post::decQtyOnCheckOutReq($qty_left, $isbn);
            echo \View\Loader::make()->render("client_reg_page.twig", array(
                "sp" => \Model\Post::getAllSp($name),
                "name" => $name,
                "sent" => true,
            ));
        }
    }
}
