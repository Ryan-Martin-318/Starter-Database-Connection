<?php
declare(strict_types=1);

// Step 1: require the database connection (includes/database.php)
require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Product.php';

// Step 3: write the SELECT from two tables (FROM products, categories WHERE the IDs match), then query() and fetchAll(PDO::FETCH_ASSOC)
function getProducts(PDO $db): array
{
    $sql = 'SELECT products.productID, products.productCode, products.productName,
                    products.description, products.listPrice,
                    products.categoryID, categories.categoryName
            FROM products, categories
            WHERE products.categoryID = categories.categoryID
            ORDER BY products.productName';

    $statement = $db->query($sql);
    $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    $products = [];
    foreach ($recordSet as $row) {
        $products[] = Product::fromRow($row);
    }

    return $products;
}
// Step 5: turn each row into a Product with Product::fromRow()
$products = getProducts($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guitar Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #adb5bd; padding: 0.4rem 0.8rem; text-align: left; }
        th { background: #343a40; color: #fff; }
    </style>
</head>
<body>
    <h1>Guitar Shop</h1>

    <table>
        <thead>
            <tr><th>Code</th><th>Product</th><th>Category</th><th>Price</th></tr>
        </thead>
        <tbody>
            <!-- Step 3: one <tr> for each product, every value escaped with htmlspecialchars() -->
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product->code) ?></td>
                    <td><?= htmlspecialchars($product->name) ?></td>
                    <td><?= htmlspecialchars($product->category) ?></td>
                    <td><?= $product->formattedPrice() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
