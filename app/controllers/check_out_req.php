<?php

namespace Controller;

class Check_out_reqs{
    public function get(){
        //session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("check_out_req.twig", array(
            "reqs" => \Model\Post::get_all_req(),
        ));
    }
        else require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
         $array = $_POST["check_out_req"];
         $array2 = $_POST["end"];
         $array3 = $_POST["check_out_req_d"];
        //echo $array;
    //    echo var_dump($array);
    //    if(isset($_POST['delete_book'])){
 
    //     // Count total files
    //     $countfiles = count($_FILES['name']);
    //    }
    //    for($i=0;$i<$countfiles;$i++){
    //        $del = \Model\Post::del()
    //    }
    //echo "Q1";
       if($array2!=null){
           require __DIR__."./../views/templates/admin_log_page.twig";
       }
       else if($array!=null){
           //echo "Q2";
           $str_arr = explode (",--", $array); 
           $name = $str_arr[1];
           $array = $str_arr[0];
        \Model\Post::check_req($array,$name);
           //echo "Q3";
             echo \View\Loader::make()->render("check_out_req.twig", array(
                 //echo "E1";
                 "reqs" => \Model\Post::get_all_req(),
                 "approved" => true,
             ));
             //echo "Q4";
       }
       else if($array3!=null){
        //echo "Q2";
        $str_arr = explode (",--", $array3); 
        $name = $str_arr[1];
        $array3 = $str_arr[0];
     \Model\Post::check_req_d($array3,$name);
        //echo "Q3";
          echo \View\Loader::make()->render("check_out_req.twig", array(
              //echo "E1";
              "reqs" => \Model\Post::get_all_req(),
              "disapproved" => true,
          ));
          //echo "Q4";
    }
    }
}