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
    
    public static function getUserData($id) {
        return parent::query("SELECT * FROM users WHERE id = $id");
    }
}
