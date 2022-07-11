<?php

namespace Controller;

class Delete_books{
    public function get(){
        session_start();
        echo \View\Loader::make()->render("delete_books.twig", array(
            "posts" => \Model\Post::get_all(),
        ));
    }
    public function post(){
         $array = $_POST["delete_books"];
         $array2 = $_POST["end"];
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
        \Model\Post::delete_book($array);
           //echo "Q3";
             echo \View\Loader::make()->render("delete_books.twig", array(
                 //echo "E1";
                 "posts" => \Model\Post::get_all(),
                 "deleted" => true,
             ));
             //echo "Q4";
       }
    }
}