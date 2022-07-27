<?php

namespace Controller;

class DeleteBooks
{
    public function get()
    {
        session_start();
        if ($_SESSION["logged_ad"] == true) {
            echo \View\Loader::make()->render("delete_books.twig", array(
                "posts" => \Model\Post::getAll(),
            ));
        } else require __DIR__ . "./../views/templates/home.twig";
    }

    public function post()
    {
        session_start();
        if (isset($_POST["end"])) {
            $array2 = $_POST["end"];
            $_SESSION["logged_ad"] = true;
            header("Location: /admin_log_page");
            exit();
        } 
        else {
            $book_name = $_POST["delete_books"];
            \Model\Post::deleteBook($book_name);
            echo \View\Loader::make()->render("delete_books.twig", array(
                "posts" => \Model\Post::getAll(),
                "deleted" => true,
            ));
        }
    }
}
