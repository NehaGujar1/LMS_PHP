<?php

namespace Controller;

class Client_reg_pg{
    
    public function get($name){
        //session_start();
        if($_SESSION["reg_cl"] == true){
        echo \View\Loader::make()->render("client_reg_page.twig", array(
            "sp" => \Model\Post::get_all_sp(),
            "name" => $name,
        ));}
        else require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        $bk_name = $_POST["client_reg_pg"];
        $end = $_POST["end"];
        $log_out = $_POST["Log_out"];
        if($log_out=='Log out') {
            require __DIR__."./../views/templates/home2.twig";
        }
        else if($end!=null){
            require __DIR__."./../views/templates/client_log.twig";
        }
        else{
        $str_arr = explode (",--", $bk_name); 
        $name = $str_arr[1];
        $isbn = $str_arr[0];
        $res = \Model\Post::check_r_c($name,$isbn);
        echo \View\Loader::make()->render("client_reg_page.twig", array(
            "sp" => \Model\Post::get_all_sp(),
            "name" => $name,
            "sent" => true,
        ));
    }
    }
}