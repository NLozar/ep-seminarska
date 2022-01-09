<?php

// enables sessions for the entire app
session_start();

require_once("controller/ItemController.php");
require_once("controller/ItemRESTController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/logout$/" => function ($method) {
        ItemController::logout();
    },
    "/^login$/" => function ($method){
        ItemController::login();
    },
    "/^register$/" => function ($method){
        ItemController::register();
    },
    "/^items$/" => function ($method) {
        ItemController::index();
    },
    "/^items\/(\d+)$/" => function ($method, $id) {
        ItemController::get($id);
    },
    "/^profile$/" => function ($mehtod) {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            if ($mehtod == "POST") {
                ItemController::updateProfile($_SESSION["id"]);
            }
            else {
                ItemController::profile($_SESSION["id"]);
            }
        }
        else {
            ItemController::index();
        }
    },
    "/^admin$/" => function ($method) {
        if (isset($_SESSION["loggedin"]) && $_SESSION["typeOfUser"] == 'A') {
            ItemController::adminView();
        }
        else {
            ItemController::index();
        }
    },
    "/^sellerEdit\/(\d+)$/" => function ($method, $id) {
        if (isset($_SESSION["loggedin"]) && $_SESSION["typeOfUser"] == 'A') {
            if ($method == "POST") {
                ItemController::editSellerForm($id);
            }
            else {
                ItemController::sellerEdit($id);
            }
        }
    },
    "/^items\/add$/" => function ($method) {
        if ($method == "POST") {
            ItemController::add();
        } else {
            ItemController::addForm();
        }
    },
    "/^items\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemController::edit($id);
        } else {
            ItemController::editForm($id);
        }
    },
    "/^items\/delete\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemController::delete($id);
        }
    },
    "/^items\/(\d+)\/(foo|bar|baz)\/(\d+)$/" => function ($method, $id, $val, $num) {
        // primer kako definirati funkcijo, ki vzame dodatne parametre
        // http://localhost/netbeans/mvc-rest/books/1/foo/10
        echo "$id, $val, $num";
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "items");
    },
    # REST API
    "/^api\/items\/(\d+)$/" => function ($method, $id) {
        
        switch ($method) {
            case "PUT":
                ItemRESTController::edit($id);
                break;
            default: # GET
                ItemRESTController::get($id);
                break;
        }
    },
    "/^api\/items$/" => function ($method) {
        switch ($method) {
            case "POST":
                ItemRESTController::add();
                break;
            default: # GET
                ItemRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
