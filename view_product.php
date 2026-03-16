
<?php 

try {
    
    require_once "db_connect.php";

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (\Throwable $th) {
    echo "error";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table cellpadding="8" border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['product_id'])?></td>
            <td><?= htmlspecialchars($product['product_name'])?></td>
            <td><?= htmlspecialchars($product['category'])?></td>
            <td><?= htmlspecialchars($product['price'])?></td>
            <td><?= ($product['stock'] < 5) ? ("Low Stock Warning") : ($product['stock']);?></td>
            <td>
                <button><a href="update_product.php?action=update&product_id=<?= $product['product_id']?>">Update</a></button>
                <button><a href="delete_product.php?action=delete&product_id=<?= $product['product_id']?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

    <a href="admin.php">back to admin page</a>
</table>
</body>
</html>