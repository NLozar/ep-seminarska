<?php 
#require_once '../controller/ItemController.php';?>
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
    echo "<a href=\"https://" . $_SERVER["HTTP_HOST"] . $base_url . "/login\">Log in</a>";
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


<!--<?php/* if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["typeOfUser"] == 'B'):?>
<div class="cart">
    <h3>Košarica</h3>
    <p><?php
    if (isset($_SESSION["cart"])) {
        var_dump($_SESSION["cart"]);
        ?>
    <?php foreach ($_SESSION["cart"] as $id => $quantity):?>
        <form action="<?= $url ?>" method="post">
            <?php if ($quantity != 0) {
                $item = ItemController::getItemDataById($id)?>
            <?= $item["author"]?>: <?= $item["title"]?>(<?=number_format($item["price"], 2) ?> EUR)
            <p><?=$item["price"] * $quantity?></p>
            <input type="hidden" name="do" value="update"/>
            <input type="hidden" name="id" value="<?= $item["id"] ?>"/>
            <input type="number" name="quantity" min="0" step="1" value="<?=$quantity?>"/>
            <button type="submit">Update</button>
            <?php } ?>
        </form>
    <br>
    <?php endforeach; ?>
    <form action="<?= $url ?>" method="post">
        <input type="hidden" name="do" value="purge_cart" />
        <button type="submit">Izprazni</button>
    </form>
        <?php
    } else {
        echo "Košara je prazna.";
    }            
    ?></p>
</div>
<?php# endif; ?>*/