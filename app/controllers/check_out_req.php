<?php

namespace Controller;

class CheckOutReqs
{
    public function get()
    {
        session_start();
        if ($_SESSION["logged_ad"] == true) {
            echo \View\Loader::make()->render("check_out_req.twig", array(
                "reqs" => \Model\Post::getAllReq(),
            ));
        } else
            require __DIR__ . "./../views/templates/home2.twig";
    }

    public function post()
    {
        session_start();
        if (isset($_POST["end"])) {
            $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
        } 
        else if (isset($_POST["check_out_req"])) {
            $temp = $_POST["check_out_req"];
            $str_arr = explode(",--", $temp);
            $name = $str_arr[1];
            $isbn = $str_arr[0];
            $time = time();
            \Model\Post::checkReq($isbn, $name, $time);
            echo \View\Loader::make()->render("check_out_req.twig", array(
                "reqs" => \Model\Post::getAllReq(),
                "approved" => true,
            ));
        } 
        else if (isset($_POST["check_out_req_d"])) {
            $temp = $_POST["check_out_req_d"];
            $str_arr = explode(",--", $temp);
            $name = $str_arr[1];
            $isbn = $str_arr[0];
            $res = \Model\Post::checkReqD($isbn, $name);
            $qty_left = $res + 1;
            \Model\Post::checkReqDUpdateQty($isbn, $qty_left);
            echo \View\Loader::make()->render("check_out_req.twig", array(
                "reqs" => \Model\Post::getAllReq(),
                "disapproved" => true,
            ));
        }
    }
}
