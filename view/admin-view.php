<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Store</title>

<h1>All users</h1>
<?php
$base_url = BASE_URL;
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo "<a href=\"$base_url/logout\">Log out</a>";
}
else {
    echo "<a href=\"$base_url/login\">Log in</a>";
}
?>

<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    #url_base = rtrim($_SERVER["SCRIPT_NAME"]);
    echo "<br><a href=\"$base_url/items/add\">Add new</a>";
}
?>

<ul>
    <?php
    foreach ($users as $user): ?>
        <li><?= $user["username"] ?></li>
    <?php endforeach;?>
   
</ul>
