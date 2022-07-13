<?php

namespace Controller;

class DeleteBooks{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("delete_books.twig", array(
            "posts" => \Model\Post::get_all(),
        ));
    }
    else require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        session_start();
       if(isset($_POST["end"])){
        $array2 = $_POST["end"];
           $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
       }
       else{
        $array = $_POST["delete_books"];
        \Model\Post::delete_book($array);
             echo \View\Loader::make()->render("delete_books.twig", array(
                 "posts" => \Model\Post::get_all(),
                 "deleted" => true,
             ));
       }
    }
}