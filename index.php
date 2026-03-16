<?php 

try {
    
    // connecting to database 
    require_once "db_connect.php";

    $stmt     = $pdo->query("SELECT * FROM products"); // runs directly
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
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['product_name'])?></td>
            <td><?= htmlspecialchars($product['category'])?></td>
            <td><?= htmlspecialchars($product['price'])?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>