<?php

namespace Controller;

class Home {
    // public function get() {
    //     echo \View\Loader::make()->render("templates/home.twig", array(
    //         "posts" => \Model\Post::get_all(),
    //     ));
    // }
    // public function post() {
    //     $caption = $_POST["caption"];
    //     \Model\Post::create($caption);
    //     echo \View\Loader::make()->render("templates/home.twig", array(
    //         "posts" => \Model\Post::get_all(),
    //         "posted" => true,
    //     ));
    // }
    public function get() {
        session_destroy();
        // echo "Hello";
        // echo __DIR__;
        require __DIR__."./../views/templates/home2.twig";
    }
    public function post() {
        $admin = $_POST["admin_in"];
        $client = $_POST["client_in"];
        // echo "hello";
        // echo $admin;
        // echo $client;
        if($admin==admin) {
            // echo "hi1";
            require __DIR__."./../views/templates/admin.twig";
            
        }
        else if($client==client) {
            // echo "hi2";
            //redirect('/Controller/Client');
            require __DIR__."./../views/templates/client.twig";
        }
    }
}
