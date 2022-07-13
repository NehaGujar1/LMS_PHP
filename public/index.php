<?php

require __DIR__ . "/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/post/:number" => "\Controller\Post",
    "/client" => "\Controller\Client",
    "/admin" => "\Controller\Admin",
    "/client_reg" => "\Controller\ClientReg",
    "/client_log" => "\Controller\ClientLog",
    "/admin_reg" => "\Controller\AdminReg",
    "/admin_log" => "\Controller\AdminLog",
    "/admin_log_page" => "\Controller\AdminLogPage",
    "/add_books" => "\Controller\AddBooks",
    "/delete_books" => "\Controller\DeleteBooks",
    "/check_out_req" => "\Controller\CheckOutReqs",
    "/admin_reg_app" => "\Controller\AdminApp",
    "/client_reg_pg" => "\Controller\ClientRegPg",
    "/client_log_pg" => "\Controller\ClientLogPg",
    "/log_out" => "\Controller\LogOut",
    "/any_data_pg" => "\Controller\AnyDataPg",
));
