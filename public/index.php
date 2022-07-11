<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/post/:number" => "\Controller\Post",
    "/client" => "\Controller\Client",
    "/admin" => "\Controller\Admin",
    "/client_reg" => "\Controller\Client_reg",
    "/client_log" => "\Controller\Client_log",
    "/admin_reg" => "\Controller\Admin_reg",
    "/admin_log" => "\Controller\Admin_log",
    "/admin_log_page" => "\Controller\Admin_log_page",
    "/add_books" => "\Controller\Add_books",
    "/delete_books" => "\Controller\Delete_books",
    "/check_out_req" => "\Controller\Check_out_reqs",
    "/admin_reg_app" => "\Controller\Admin_app",
    "/client_reg_pg" => "\Controller\Client_reg_pg",
    "/client_log_pg" => "\Controller\Client_log_pg",
    "/log_out" => "\Controller\Log_out",
));