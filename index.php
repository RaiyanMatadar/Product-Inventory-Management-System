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
            gap: 1.5rem;
            padding: 3rem 2rem;
        }

        h1 {
            font-size: 0.95rem;
            font-weight: 400;
            color: #999;
            letter-spacing: 0.06em;
        }

        table {
            width: 100%;
            max-width: 700px;
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

        /* price column — last td per row */
        td:last-child {
            color: #888;
            font-weight: 300;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafaf8;
        }
    </style>
</head>
<body>

<h1>Hey user welcome to the website</h1>


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