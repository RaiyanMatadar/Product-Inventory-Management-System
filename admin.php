<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    try {
        $product_name = $_POST["product_name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        
        require_once "db_connect.php";

        if (empty($product_name) || empty($category) || empty($price) || empty($stock)) {
            header("Location: admin.php");
            exit();
        }

        $query = "INSERT INTO products (product_name,category,price,stock) 
                  VALUES (:product_name,:category,:price,:stock);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam("product_name",$product_name);
        $stmt->bindParam("category",$category);
        $stmt->bindParam("price",$price);
        $stmt->bindParam("stock",$stock);

        $stmt->execute();
                

    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product inventory managment System</title>
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

        form {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: #ffffff;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 32px rgba(0,0,0,0.05);
        }

        input {
            width: 100%;
            background: #fafaf8;
            border: 1px solid #efefec;
            border-radius: 7px;
            padding: 0.75rem 1rem;
            color: #2a2a2a;
            font-size: 0.82rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #bbb;
            text-transform: capitalize;
        }

        input:focus {
            border-color: #ccc;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        button {
            margin-top: 0.4rem;
            width: 100%;
            padding: 0.8rem;
            background: #2a2a2a;
            color: #f5f4f0;
            border: none;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 500;
            font-family: inherit;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        button:hover {
            background: #111;
        }

        button:active {
            transform: scale(0.98);
        }

        a {
            display: block;
            width: 100%;
            max-width: 420px;
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
    
    <form action="admin.php" method="post">
        <input type="text" name="product_name" placeholder="enter Product Name">
        <input type="text" name="category" placeholder="enter category">
        <input type="number" name="price" placeholder="enter price">
        <input type="number" name="stock" placeholder="enter stock">
        <button type="submit">submit</button>
    </form>

    <a href="view_product.php">View Products</a>
    <a href="index.php">Go to user page</a>
</body>
</html>