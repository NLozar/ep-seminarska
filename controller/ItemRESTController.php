<?php

require_once("model/StoreDB.php");
require_once("controller/ItemController.php");
require_once("ViewHelper.php");

class ItemRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(StoreDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(StoreDB::getAllwithURI(["prefix" => $prefix]));
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, ItemController::getRules());

        if (ItemController::checkValues($data)) {
            $id = StoreDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/items/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, ItemController::getRules());

        if (ItemController::checkValues($data)) {
            $data["id"] = $id;
            StoreDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 204 v primeru uspeha oz. kodo 404, če knjiga ne obstaja
        // https://www.restapitutorial.com/httpstatuscodes.html
        $_DELETE = [];
        if ($id){
            StoreDB::delete ($id);
            echo ViewHelper::renderJSON("Deleted successfully", 204);
        }
        else{
            echo ViewHelper::renderJSON("Book not found", 404);
        }
    }
    
}
