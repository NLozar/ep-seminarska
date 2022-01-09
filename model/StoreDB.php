<?php

require_once 'model/AbstractDB.php';

class StoreDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO item (author, title, description, price) "
                        . " VALUES (:author, :title, :description, :price)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE item SET author = :author, title = :title, "
                        . "description = :description, price = :price"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM item WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $items = parent::query("SELECT id, author, title, description, price"
                        . " FROM item"
                        . " WHERE id = :id", $id);

        if (count($items) == 1) {
            return $items[0];
        } else {
            throw new InvalidArgumentException("No such item");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, author, title, price, description"
                        . " FROM item"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, author, title, price"
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM item "
                        . "ORDER BY id ASC", $prefix);
    }

    public static function getAllUsers() {
        return parent::query("SELECT * FROM users");
    }
    
    public static function getUserDataById($id) {
        return parent::query("SELECT * FROM users WHERE id = $id");
    }
    
    public static function editSeller(array $data) {
        #return parent::modify("UPDATE users SET username = :username, password = :password, active = :active WHERE id = :id", $data);
        $link = mysqli_connect("localhost", "root", "ep", "onlinestore");
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, password_hash($_POST["password"], PASSWORD_DEFAULT));
        $active = mysqli_real_escape_string($link, $_POST["active"]);
        $id = $_POST["id"];
        $sql = "UPDATE users SET username = ?, password = ?, active = ? where id = ?;";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            throw new Exception("SQL error.");
        } else {
            mysqli_stmt_bind_param($stmt, "ssdd", $username, $password, $active, $id);
            mysqli_stmt_execute($stmt);
        }
    }
}
