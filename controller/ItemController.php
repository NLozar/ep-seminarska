<?php

require_once("model/StoreDB.php");
require_once("ViewHelper.php");

class ItemController {
    
    public static function register() {
        echo ViewHelper::render ("view/register.php");
    }
    
    public static function login() {
        echo ViewHelper::render ("view/login.php");
    }
    
    public static function logout() {
        $_SESSION["loggedin"] = false;
        unset($_SESSION["loggedin"]);
        session_destroy();
        header("location: ../items");
        echo ViewHelper::render("view/item-list.php", ["items" => StoreDB::getAll()]);
    }


    public static function get($id) {
        echo ViewHelper::render("view/item-detail.php", StoreDB::get(["id" => $id]));
    }
    
    public static function getItemDataById($id) {
        return StoreDB::get($id);
    }

    public static function index() {
        echo ViewHelper::render("view/item-list.php", [
            "items" => StoreDB::getAll()
        ]);
    }

    public static function addForm($values = [
        "author" => "",
        "title" => "",
        "price" => "",
        "description" => "",
        "active" => 1
    ]) {
        echo ViewHelper::render("view/item-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = StoreDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "items/" . $id);
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = StoreDB::get(["id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }

        echo ViewHelper::render("view/item-edit.php", $values);
    }

    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $data["id"] = $id;
            StoreDB::update($data);
            ViewHelper::redirect(BASE_URL . "items/" . $data["id"]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete($id) {
        $data = filter_input_array(INPUT_POST, [
            'delete_confirmation' => FILTER_REQUIRE_SCALAR
        ]);

        if (self::checkValues($data)) {
            StoreDB::delete(["id" => $id]);
            $url = BASE_URL . "items";
        } else {
            $url = BASE_URL . "items/edit/" . $id;
        }

        ViewHelper::redirect($url);
    }
    
    public static function profile($id) {
        echo ViewHelper::render("view/profile.php", ["data" => StoreDB::getUserDataById($id)]);
    }
    
    public static function updateProfile($id) {
        $data["id"] = $id;
        $data["username"] = filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["username"]);
        $data["password"] = password_hash(filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["password"]), PASSWORD_DEFAULT);
        if ($_SESSION["typeOfUser"] == 'B') {
            $data["streetAddress"] = filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["streetAddress"]);
            $data["numberAddress"] = filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["numberAddress"]);
            $data["postNumber"] = filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["postNumber"]);
        }
        StoreDB::editProfile($data);
        $_SESSION["username"] = $data["username"];
        $url = "";
        if ($_SESSION["typeOfUser"] == 'A') {
            $url = BASE_URL . "admin";
        }
        else {
            $url = BASE_URL . "items";
        }
        ViewHelper::redirect($url);
        #echo "update command recieved";
    }
    
    public static function adminView() {
        echo ViewHelper::render("view/admin-view.php", ["users" => StoreDB::getAllUsers()]);
    }
    
    public static function sellerEdit($id) {
        echo ViewHelper::render("view/edit-seller.php", ["data" => StoreDB::getUserDataById($id)]);
    }
    
    public static function editSellerForm($id) {
        $data["id"] = $id;
        $data["username"] = filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["username"]);
        $data["password"] = password_hash(filter_input(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $_POST["password"]), PASSWORD_DEFAULT);
        $data["active"] = $_POST["active"];
        StoreDB::editSeller($data);
        $url = BASE_URL . "admin";
        ViewHelper::redirect($url);
    }

    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'author' => FILTER_SANITIZE_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
        ];
    }
    
    public static function userRules() {
        return [
            "username" => FILTER_SANITIZE_SPECIAL_CHARS,
            "password" => FILTER_SANITIZE_SPECIAL_CHARS,
            "active" => FILTER_SANITIZE_SPECIAL_CHARS,
            "id" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
}
