<?php

namespace Controller;

class ClientLogPg
{
    public function get($name)
    {
        session_start();
        if ($_SESSION["logged_cl"] == true) {
            echo \View\Loader::make()->render("client_log_page.twig", array(
                "sp" => \Model\Post::getAllSp($name),
                "ur" => \Model\Post::urBk($name),
                "name" => $name,
                "var" => \Model\Post::feesFound($name),
            ));
        } else require __DIR__ . "./../views/templates/home2.twig";
    }

    public function post()
    {
        if (isset($_POST["Log_out"])) {
            header("Location: /");
            exit();
        } 
        else if (isset($_POST["end"])) {
            header("Location: /client_log");
            exit();
        } 
        else {
            if (isset($_POST["client_log_pg"])) {
                $bk_name = $_POST["client_log_pg"];
                $str_arr = explode(",--", $bk_name);
                $name = $str_arr[1];
                $isbn = $str_arr[0];
                $res = \Model\Post::checkRC($name, $isbn);
                $qty_left = $res[4] - 1;
                \Model\Post::checkRCPost($qty_left, $isbn);
            }
            if (isset($_POST["ur_bkk"])) {
                $ck_name = $_POST["ur_bkk"];
                $str_arr = explode(",--", $ck_name);
                $name = $str_arr[1];
                $isbn2 = $str_arr[0];
                $res2 = \Model\Post::urBkDlt($name, $isbn2);
                $qty_left = $res2[4] + 1;
                \Model\Post::urBkDltPost($name, $isbn2, $qty_left);
                $time = time();
                $fees = 0;
                $diff = $time - $res2[2];
                if ($diff > 604800) {
                    //Every day charge is 1 Rs
                    $fees = (int)(($diff - 604800) / 86400);
                }
                $res = \Model\Post::urBkDltPostPost($name, $isbn2, $fees, $time);
                $fees = $res[1] + $fees;
                \Model\Post::urBkDltPostPostPost($name, $fees);
            }
            echo \View\Loader::make()->render("client_log_page.twig", array(
                "sp" => \Model\Post::getAllSp($name),
                "ur" => \Model\Post::urBk($name),
                "name" => $name,
                "sent" => true,
                "var" => \Model\Post::feesFound($name),
            ));
        }
    }
}
