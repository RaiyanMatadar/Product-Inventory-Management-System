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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #f5f4f0;
            font-family: 'DM Mono', monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.2rem;
            padding: 3rem 2rem;
        }

        table {
            width: 100%;
            max-width: 860px;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 32px rgba(0,0,0,0.05);
        }

        th {
            background: #fafaf8;
            color: #999;
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 1rem 1.4rem;
            text-align: left;
            border-bottom: 1px solid #efefec;
        }

        td {
            padding: 0.95rem 1.4rem;
            font-size: 0.82rem;
            color: #2a2a2a;
            border-bottom: 1px solid #f2f2ee;
            letter-spacing: 0.01em;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafaf8;
        }

        /* price and stock columns */
        td:nth-child(4) {
            color: #888;
            font-weight: 300;
        }

        /* low stock warning text styling — no class needed, targets the td content via the cell */
        td:nth-child(5) {
            color: #2a2a2a;
        }

        /* when td contains "Low Stock Warning" text — use :has if supported, fallback handled visually */
        td:nth-child(5):not(:empty) {
            font-size: 0.75rem;
        }

        td:last-child {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        button {
            background: #fafaf8;
            border: 1px solid #efefec;
            border-radius: 6px;
            cursor: pointer;
            padding: 0;
            transition: border-color 0.2s, background 0.2s, transform 0.1s;
        }

        button:hover {
            background: #f0f0ec;
            border-color: #ddd;
        }

        button:active {
            transform: scale(0.97);
        }

        button:last-child {
            border-color: #fce8e8;
        }

        button:last-child:hover {
            background: #fdf2f2;
            border-color: #f5c0c0;
        }

        button a {
            display: block;
            padding: 0.4rem 0.85rem;
            font-size: 0.75rem;
            font-weight: 500;
            font-family: inherit;
            letter-spacing: 0.03em;
            text-decoration: none;
            color: #555;
            background: none;
            border: none;
            border-radius: 0;
            width: auto;
            max-width: none;
            box-shadow: none;
        }

        button:last-child a {
            color: #c0605e;
        }

        button a:hover {
            background: none;
            border-color: none;
        }

        button a:active {
            transform: none;
        }

        a {
            display: block;
            width: 100%;
            max-width: 860px;
            padding: 0.8rem;
            background: #ffffff;
            color: #2a2a2a;
            font-size: 0.82rem;
            font-weight: 500;
            font-family: inherit;
            letter-spacing: 0.04em;
            text-decoration: none;
            text-align: center;
            border-radius: 7px;
            border: 1px solid #efefec;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: background 0.2s, border-color 0.2s, transform 0.1s;
        }

        a:hover {
            background: #fafaf8;
            border-color: #ddd;
        }

        a:active {
            transform: scale(0.98);
        }
    </style>
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