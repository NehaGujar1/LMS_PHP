<?php

namespace Controller;

class ClientLogPg{
    public function get($name){
        session_start();
        if($_SESSION["logged_cl"] == true){
        echo \View\Loader::make()->render("client_log_page.twig", array(
            "sp" => \Model\Post::GetAllSp($name),
            "ur" => \Model\Post::UrBk($name),
            "name" => $name,
            "var" => \Model\Post::FeesFound($name),
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
        $res = \Model\Post::CheckRC($name,$isbn);
            }
            if( isset($_POST["ur_bkk"])){
                $ck_name = $_POST["ur_bkk"];
                $str_arr = explode (",--", $ck_name); 
        $name = $str_arr[1];
        $isbn2 = $str_arr[0];
            $res2 = \Model\Post::UrBkDlt($name,$isbn2);
            $time = time();
            $fees = 0;
            $diff = $time - $res2[2];
            if($diff>604800){
               //Every day charge is 1 Rs
               $fees = (int)(($diff -604800)/86400) ;}
               \Model\Post::UrBkDltPost($name,$isbn2,$fees,$time);
            }
        echo \View\Loader::make()->render("client_log_page.twig", array(
            "sp" => \Model\Post::GetAllSp(),
            "ur" => \Model\Post::UrBk($name),
            "name" => $name,
            "sent" => true,
            "var" => \Model\Post::FeesFound($name),
        ));
    }
    }
}