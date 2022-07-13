<?php

namespace Controller;

class AddBooks{
    public function get(){
        session_start();
        if($_SESSION["logged_ad"] == true){
        echo \View\Loader::make()->render("add_books.twig", array(
            "posts" => \Model\Post::GetAll(),
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
        
        $res = \Model\Post::AddBook($bk_name,$author,$qty);
        if($res==null){
            $isbn = time()*1000;
            \Model\Post::AddBookOnResNull($bk_name,$author,$qty,$isbn);
        }
        else{
            $qty = $res[3] + $qty ;
            $qty_left = $res[4] + $qty ;
            \Model\Post::AddBookQtyInc($name,$qty,$qty_left);
        }
        echo \View\Loader::make()->render("add_books.twig", array(
            "posts" => \Model\Post::GetAll(),
            "added" => true,
        ));}
        else {
            echo \View\Loader::make()->render("add_books.twig", array(
                "posts" => \Model\Post::GetAll(),
            ));
        
    }
    }
}