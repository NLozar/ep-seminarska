<?php
$username = $_SESSION["username"];
$pass = ""
?>

<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Profile</title>

<p>Edit your information</p>
<p>[<a href="<?= BASE_URL . "items" ?>">All Items</a>]</p>

<form action="<?= BASE_URL . "profile"?>" method="post">
    <p><label>User name: <input type="text" name="username" value="<?= $username ?>" autofocus/></label></p>
    <p><label>Password: <input type="password" name="title" value="<?= $pass ?>"/></label></p>
</form>