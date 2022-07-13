<?php

namespace Controller;

class AddBooks{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("add_books.twig", array(
            "posts" => \Model\Post::get_all(),
        ));
    }
    else 
    require __DIR__."./../views/templates/home2.twig";
    }
    public function post(){
        session_start();
        if(isset($_POST["add_new_book"])) $bk_name = $_POST["add_new_book"];
        if(isset($_POST["add_author"])) $author = $_POST["add_author"];
        if(isset($_POST["add_qty"])) $qty = $_POST["add_qty"];
        if($_POST["end"]){  
            $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
        }
        else if(isset($_POST["add_new_book"])&&isset($_POST["add_author"])&&isset($_POST["add_qty"])){
        
        $res = \Model\Post::add_book($bk_name,$author,$qty);
        echo \View\Loader::make()->render("add_books.twig", array(
            "posts" => \Model\Post::get_all(),
            "added" => true,
        ));}
        else {
            echo \View\Loader::make()->render("add_books.twig", array(
                "posts" => \Model\Post::get_all(),
            ));
        
    }
    }
}