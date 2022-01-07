<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Item detail</title>

<h1>Details of: <?= $title ?></h1>

<p>[
    <a href="<?= BASE_URL . "items" ?>">All items</a> |
    <a href="<?= BASE_URL . "items/add" ?>">Add new</a>
    ]</p>

<ul>
    <li>Author: <b><?= $author ?></b></li>
    <li>Title: <b><?= $title ?></b></li>
    <li>Price: <b><?= $price ?> EUR</b></li>
    <li>Description: <i><?= $description ?></i></li>
</ul>

<p>[ <a href="<?= BASE_URL . "items/edit/" . $id ?>">Edit</a> |
    <a href="<?= BASE_URL . "items" ?>">Item index</a> ]</p>
