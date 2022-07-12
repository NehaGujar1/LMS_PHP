<?php

namespace Controller;

class Add_books{
    public function get(){
        session_start();
        echo \View\Loader::make()->render("add_books.twig", array(
            "posts" => \Model\Post::get_all(),
        ));
    }
    public function post(){
        $bk_name = $_POST["add_new_book"];
        $author = $_POST["add_author"];
        $qty = $_POST["add_qty"];
        $array2 = $_POST["end"];
        if($array2!=null){
            require __DIR__."./../views/templates/admin_log_page.twig";
        }
        else{
        $res = \Model\Post::add_book($bk_name,$author,$qty);
        echo \View\Loader::make()->render("add_books.twig", array(
            //echo "E1";
            "posts" => \Model\Post::get_all(),
            "added" => true,
        ));
    }
    }
}