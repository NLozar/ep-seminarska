<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Store</title>

<h1>All items</h1>

<p>[
<a href="<?= BASE_URL . "items" ?>">All items</a> |
<a href="<?= BASE_URL . "items/add" ?>">Add new</a>
]</p>

<ul>

    <?php foreach ($items as $item): ?>
        <li><a href="<?= BASE_URL . "items/" . $item["id"] ?>"><?= $item["author"] ?>: 
        	<?= $item["title"] ?> </a></li>
    <?php endforeach; ?>

</ul>
