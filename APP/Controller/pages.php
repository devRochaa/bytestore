<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {

    case "/":
        return require("./View/home.php");

    case "/login":
        return require("./View/login.php");

    case "/admin":
        return require("./View/admin.php");

    case "/logout":
        return require("./Controller/logout.php");

    case "/editar":
        return require("./View/edit.php");

        case "/deletar":
            return require("./Controller/delete.php");
    
        case "/create":
        return require("./View/create.php");

    case "/teste":
        return require("./View/teste.php");

    case "/register":
        return require("./View/register.php");

    default:
        return require("./View/404.php");
}
