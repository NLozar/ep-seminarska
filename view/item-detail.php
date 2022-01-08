<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Item detail</title>

<h1>Details of: <?= $title ?></h1>
<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo "[";
    echo "<a href=\"./add\">Add new</a>";
    echo " | ";
    echo "<a href=\".\">All items</a>";
    echo "]";
}
else {
    echo "[";
    echo "<a href=\".\">All items</a>";
    echo "]";
}
?>

<ul>
    <li>Seller: <b><?= $author ?></b></li>
    <li>Title: <b><?= $title ?></b></li>
    <li>Price: <b><?= $price ?> EUR</b></li>
    <li>Description: <i><?= $description ?></i></li>
</ul>

<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["username"] === $author) {
        echo "[";
        echo "<a href=\"./edit/$id\">Edit item</a>";
        echo "]";
    }
}

?>



