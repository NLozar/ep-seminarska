<?php
$username = $_SESSION["username"];
$pass = ""
?>

<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Profile</title>

<?php if ($_SESSION["typeOfUser"] == 'A') {
    $url = BASE_URL . "admin";
    echo "<p>[<a href=\"$url\">Back</a>]</p>";
} else {
    $url = BASE_URL . "items";
    echo "<p>[<a href=\"$url\">All Items</a>]</p>";
}?>
<p>Edit your information</p>

<form action="<?= BASE_URL . "profile/"?>" method="post">
    <input type="hidden" name="id" value="<?= $data[0]["id"]?>">
    <p><label>New user name: <input type="text" name="username" value="<?= $username ?>" autofocus/></label></p>
    <p><label>New password (!DO NOT LEAVE BLANK, otherwise you won't be able to log in!): <input type="password" name="password" value="<?= $pass ?>"/></label></p>
    <?php
    if ($_SESSION["typeOfUser"] == 'B'):?>
        <p><label>Street: <input type="text" name="streetAddress" value="<?= $data[0]["streetAddress"] ?>" autofocus/></label></p>
        <p><label>House number: <input type="number" name="numberAddress" value="<?= $data[0]["numberAddress"] ?>" autofocus/></label></p>
        <p><label>Post number: <input type="number" name="postNumber" value="<?= $data[0]["postNumber"]?>" autofocus/></label></p>
    <?php endif;?>
    <p><button>Save</button></p>
</form>
