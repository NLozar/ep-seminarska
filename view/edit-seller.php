<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Edit entry</title>

<h1>Edit seller</h1>
<?php $base_url = BASE_URL;?>
<p><a href="<?= $base_url?>/admin">Back to sellers</a></p>

<form action="<?= BASE_URL . "sellerEdit/" . $data[0]["id"] ?>" method="post">
    <input type="hidden" name="id" value="<?= $data[0]["id"]?>">
    <p><label>Username: <input type="text" name="username" value="<?= $data[0]["username"]?>" autofocus/></label></p>
    <p><label>Password (!DO NOT LEAVE BLANK, otherwise seller won't be able to log in!): <input type="password" name="password" value="" /></label></p>
    <p><label>active: <input type="text" name="active" value="<?= $data[0]["active"] ?>"></input></label></p>
    <p><button>Update record</button></p>
</form>
