<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    require_once "db_connect.php";

    // get product_id from url and connected to variable 
    $product_id = $_GET["product_id"];

    $query = "DELETE FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":product_id",$product_id);
    
    if ($stmt->execute()) {
        echo "data deleted!";
        header("Location: view_product.php");
    } else {
        echo "could'nt delete data";
    }
}

?>