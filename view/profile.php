<?php
$username = $_SESSION["username"];
$pass = ""
?>

<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Profile</title>

<p>[<a href="<?= BASE_URL . "items" ?>">All Items</a>]</p>
<p>Edit your information</p>

<form action="<?= BASE_URL . "profile/"?>" method="post">
    <input type="hidden" name="id" value="<?= $data[0]["id"]?>">
    <p><label>New user name: <input type="text" name="username" value="<?= $username ?>" autofocus/></label></p>
    <p><label>New password: <input type="password" name="password" value="<?= $pass ?>"/></label></p>
    <?php
    if ($_SESSION["typeOfUser"] == 'B'):?>
        <p><label>Street: <input type="text" name="streetAddress" value="<?= $data[0]["streetAddress"] ?>" autofocus/></label></p>
        <p><label>House number: <input type="number" name="numberAddress" value="<?= $data[0]["numberAddress"] ?>" autofocus/></label></p>
        <p><label>Post number: <input type="number" name="postNumber" value="<?= $data[0]["postNumber"]?>" autofocus/></label></p>
    <?php endif;?>
    <p><button>Save</button></p>
</form>
