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

<form action="<?= BASE_URL . "profile"?>" method="post">
    <p><label>New user name: <input type="text" name="username" value="<?= $username ?>" autofocus/></label></p>
    <p><label>New password: <input type="password" name="title" value="<?= $pass ?>"/></label></p>
</form>

<?php
if ($_SESSION["typeOfUser"] == 'B'):?>
<form>
    <p><label>Street: <input type="text" name="username" value="<?= $data[0]["streetAddress"] ?>" autofocus/></label></p>
    <p><label>House number: <input type="text" name="username" value="<?= $data[0]["numberAddress"] ?>" autofocus/></label></p>
    <p><label>Post number: <input type="text" name="username" value="<?= $data[0]["postNumber"]?>" autofocus/></label></p>
</form>
<?php endif;