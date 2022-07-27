<?php

namespace Controller;

class AdminLogPage
{
    public function get()
    {
        session_start();
        if ($_SESSION["logged_ad"] == true) {
            require __DIR__ . "./../views/templates/admin_log_page.twig";
        } 
        else
            require __DIR__ . "./../views/templates/home.twig";
    }

    public function post()
    {
        if (isset($_POST["Log_out"])) {
            session_destroy();
            header("Location: /");
            exit();
        } 
        else if (isset($_POST["add_books"])) {
            echo \View\Loader::make()->render("add_books.twig", array(
                "posts" => \Model\Post::getAll(),
            ));
        } 
        else if (isset($_POST["delete_books"])) {

            echo \View\Loader::make()->render("delete_books.twig", array(
                "posts" => \Model\Post::getAll(),
            ));
        } 
        else if (isset($_POST["check_out_req"])) {
            echo \View\Loader::make()->render("check_out_req.twig", array(
                "reqs" => \Model\Post::getAllReq(),
            ));
        } 
        else if (isset($_POST["admin_reg_app"])) {
            echo \View\Loader::make()->render("admin_reg_app.twig", array(
                "regs" => \Model\Post::getAllReg(),
            ));
        }
    }
}
