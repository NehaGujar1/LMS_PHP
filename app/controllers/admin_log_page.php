<?php

namespace Controller;

class Admin_log_page {
    public function get () {
        session_start();
        require __DIR__."./../views/templates/admin_log_page.twig";
    }
    public function post () {
        $add_books = $_POST["add_books"];
        $delete_books = $_POST["delete_books"];
        $check_out_req = $_POST["check_out_req"];
        $admin_reg_app = $_POST["admin_reg_app"];
        $log_out = $_POST["Log_out"];
        if($log_out=='Log out') {
            require __DIR__."./../views/templates/home2.twig";
        }
        else if($add_books=='Add books') {
            echo "hello";
            // render("templates/add_books.twig", array(
            //     "post" => \Model\Post::get_all(),
            // ));
            echo "end";
            echo \View\Loader::make()->render("add_books.twig", array(
                     "posts" => \Model\Post::get_all(),
                 ));
            // require __DIR__."./../views/templates/add_books.twig";
        }
        else if($delete_books=='Delete books') {
            
            echo \View\Loader::make()->render("delete_books.twig", array(
                "posts" => \Model\Post::get_all(),
            ));
        }
        else if($check_out_req=='Check out requests') {
            echo \View\Loader::make()->render("check_out_req.twig", array(
                "reqs" => \Model\Post::get_all_req(),
            ));
        }
        else if($admin_reg_app=='Admin registration approval') {
            echo \View\Loader::make()->render("admin_reg_app.twig", array(
                "regs" => \Model\Post::get_all_reg(),
            ));
        }
    }
}