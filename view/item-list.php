<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Store</title>

<h1>All items</h1>
<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo "<a href=\"../logout\">Log out</a>";
}
else {
    echo "<a href=\"login\">Log in</a>";
}
?>

<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    #url_base = rtrim($_SERVER["SCRIPT_NAME"]);
    echo "<br><a href=\"items/add\">Add new</a>";
}
?>

<ul>

    <?php foreach ($items as $item): ?>
        <li><a href="<?= BASE_URL . "items/" . $item["id"] ?>"><?= $item["author"] ?>: 
        	<?= $item["title"] ?> </a></li>
    <?php endforeach; ?>

</ul>
