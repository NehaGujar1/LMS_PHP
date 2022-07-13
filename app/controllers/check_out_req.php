<?php

namespace Controller;

class CheckOutReqs{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("check_out_req.twig", array(
            "reqs" => \Model\Post::GetAllReq(),
        ));
    }
        else 
        require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        session_start();
       if(isset($_POST["end"])){
           $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
       }
       else if(isset($_POST["check_out_req"])){
        $array = $_POST["check_out_req"];
           $str_arr = explode (",--", $array); 
           $name = $str_arr[1];
           $array = $str_arr[0];
        \Model\Post::CheckReq($array,$name);
             echo \View\Loader::make()->render("check_out_req.twig", array(
                 "reqs" => \Model\Post::GetAllReq(),
                 "approved" => true,
             ));
       }
       else if(isset($_POST["check_out_req_d"])){
        $array3 = $_POST["check_out_req_d"];
        $str_arr = explode (",--", $array3); 
        $name = $str_arr[1];
        $array3 = $str_arr[0];
     \Model\Post::CheckReqD($array3,$name);
          echo \View\Loader::make()->render("check_out_req.twig", array(
              "reqs" => \Model\Post::GetAllReq(),
              "disapproved" => true,
          ));
    }
    }
}