<?php
declare(strict_types=1);

// Step 1: require the database connection (includes/database.php)
require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Product.php';

// Step 4: one product. Write the SELECT with a WHERE for product 3, then query() and fetch(PDO::FETCH_ASSOC)
$sql = 'SELECT products.productID, products.productCode, products.productName,
                products.description, products.listPrice,
                products.categoryID, categories.categoryName
        FROM products, categories
        WHERE products.categoryID = categories.categoryID';
$statement = $db->query($sql);
$row = $statement ->fetch(PDO::FETCH_ASSOC);
$product = Product::fromRow($row);

// Step 5: build a Product with Product::fromRow()

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; max-width: 40rem; }
    </style>
</head>
<body>
    <p><a href="products.php">&larr; All products</a></p>

    <!-- Step 4: show the name, category, price, and description (description through nl2br(htmlspecialchars(...))) -->
    <h1><?= htmlspecialchars($product->name) ?></h1>
    <p><strong><?= htmlspecialchars($product->category) ?></strong> &middot; <?= $product->formattedPrice() ?></p>
    <p><?= htmlspecialchars($product->description) ?></p>
</body>
</html>
