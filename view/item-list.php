<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Store</title>

<h1>All items</h1>
<?php
$base_url = BASE_URL;
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $uname = $_SESSION["username"];
    echo "<a href=\"$base_url/logout\">Log out</a><br>"
            . "<a href=\"$base_url/profile\">$uname</a>";
}
else {
    echo "<a href=\"$base_url/login\">Log in</a>";
}
?>

<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["typeOfUser"] == 'S') {
    echo "<br><a href=\"$base_url/items/add\">Add new</a>";
}
?>

<ul>

    <?php
    if (!isset($_SESSION["loggedin"]) || $_SESSION["typeOfUser"] == 'B'):
    foreach ($items as $item): ?>
        <?php if ($item["active"] == 1):?>
        <li><a href="<?= BASE_URL . "items/" . $item["id"] ?>"><?= $item["author"] ?>: 
        	<?= $item["title"] ?> </a></li>
    <?php endif; endforeach; endif;?>
    
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["typeOfUser"] == 'S'): ?>
        <h3>My items on sale:</h3>
        <?php
        foreach ($items as $item):
            if ($_SESSION["username"] == $item["author"]): 
                if ($item["active"] == 1):?>
                <li><a href="<?= BASE_URL . "items/" . $item["id"] ?>"><?= $item["author"] ?>: 
        	<?= $item["title"] ?> </a></li>
                <?php endif;
                if ($item["active"] == 0):?>
                <li><a href="<?= BASE_URL . "items/" . $item["id"] ?>"><?= $item["author"] ?>:
        	
                <?= $item["title"] ?> </a>(deactivated)</li>
                <?php endif;
                 endif; ?>
    <?php endforeach; endif;?>
    

</ul>
