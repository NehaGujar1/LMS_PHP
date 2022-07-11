<?php

namespace Controller;

class Admin_app{
    public function get(){
        session_start();
        echo \View\Loader::make()->render("admin_reg_app.twig", array(
            "regs" => \Model\Post::get_all_reg(),
        ));
    }
    public function post(){
         $array = $_POST["admin_reg_app"];
         $array2 = $_POST["end"];
         $array3 = $_POST["admin_reg_app_d"];
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
       else if($array!=null || $array3!=null){
           //echo "Q2";
        //    $str_arr = explode (",--", $array); 
        //    $name = $str_arr[1];
        //    $array = $str_arr[0];
        if($array!=null){
        \Model\Post::reg_approval($array);
           //echo "Q3";
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 //echo "E1";
                 "regs" => \Model\Post::get_all_reg(),
                 "approved" => true,
             ));
             //echo "Q4";
       }
       if($array3!=null){
        \Model\Post::reg_disapproval($array3);
           //echo "Q3";
             echo \View\Loader::make()->render("admin_reg_app.twig", array(
                 //echo "E1";
                 "regs" => \Model\Post::get_all_reg(),
                 "disapproved" => true,
             ));
             //echo "Q4";
       }
    }
    }
}