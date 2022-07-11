<?php

namespace Controller;

class Client_log_pg{
    public function get($name){
        session_start();
        echo \View\Loader::make()->render("client_log_page.twig", array(
            "sp" => \Model\Post::get_all_sp(),
            "ur" => \Model\Post::ur_bk($name),
            "name" => $name,
            "var" => \Model\Post::fees_found($name),
        ));
    }
    public function post(){
        $bk_name = $_POST["client_log_pg"];
        $ck_name = $_POST["ur_bkk"];
        $end = $_POST["end"];
        $log_out = $_POST["Log_out"];
        if($log_out=='Log out') {
            require __DIR__."./../views/templates/home2.twig";
        }
        else if($end!=null){
            require __DIR__."./../views/templates/client_log.twig";
        }
        else{
            if($bk_name!=null){
        $str_arr = explode (",--", $bk_name); 
        $name = $str_arr[1];
        $isbn = $str_arr[0];
        $res = \Model\Post::check_r_c($name,$isbn);
            }
            // echo \View\Loader::make()->render("client_log_page.twig", array(
            //     "sp" => \Model\Post::get_all_sp(),
            //     "ur" => \Model\Post::ur_bk($name),
            //     "name" => $name,
            //     "sent" => true,
            //     "var" => \Model\Post::fees_found($name),
            // ));
            if($ck_name!=null){
                $str_arr = explode (",--", $ck_name); 
        $name = $str_arr[1];
        $isbn2 = $str_arr[0];
            //$isbn2 = $ck_name;
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