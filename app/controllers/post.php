<?php

namespace Controller;

class Post
{
    public function get($isbn)
    {
        echo \View\Loader::make()->render("templates/add_books.twig", array(
            "post" => \Model\Post::book([$isbn])
        ));
    }
}
