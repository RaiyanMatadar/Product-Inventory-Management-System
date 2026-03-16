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