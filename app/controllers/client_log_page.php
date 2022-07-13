<?php

namespace Controller;

class ClientLogPg{
    public function get($name){
        session_start();
        if($_SESSION["logged_cl"] == true){
        echo \View\Loader::make()->render("client_log_page.twig", array(
            "sp" => \Model\Post::get_all_sp($name),
            "ur" => \Model\Post::ur_bk($name),
            "name" => $name,
            "var" => \Model\Post::fees_found($name),
        ));
    }
    else require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        if(isset($_POST["Log_out"])) {
            header("Location: /");
            exit();
        }
        else if(isset($_POST["end"])){
            header("Location: /client_log");
            exit();
        }
        else{
            if(isset($_POST["client_log_pg"])){
                $bk_name = $_POST["client_log_pg"];
        $str_arr = explode (",--", $bk_name); 
        $name = $str_arr[1];
        $isbn = $str_arr[0];
        $res = \Model\Post::check_r_c($name,$isbn);
            }
            if( isset($_POST["ur_bkk"])){
                $ck_name = $_POST["ur_bkk"];
                $str_arr = explode (",--", $ck_name); 
        $name = $str_arr[1];
        $isbn2 = $str_arr[0];
            $res2 = \Model\Post::ur_bk_dlt($name,$isbn2);
            }
        echo \View\Loader::make()->render("client_log_page.twig", array(
            "sp" => \Model\Post::get_all_sp(),
            "ur" => \Model\Post::ur_bk($name),
            "name" => $name,
            "sent" => true,
            "var" => \Model\Post::fees_found($name),
        ));
    }
    }
}