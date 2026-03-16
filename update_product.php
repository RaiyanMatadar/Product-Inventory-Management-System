<?php 

// this if is for adding the data to the input by default 
if ($_SERVER["REQUEST_METHOD"] == "GET") {

   try {
    // for connecting to databse 
    require_once "db_connect.php";

    // get product_id from url and connected to variable 
    $product_id = $_GET["product_id"];

    // query for selecting specific student details 
    $query = "SELECT * FROM products WHERE product_id = $product_id";

    // made query with prepare statement to make it secure
    $stmt = $pdo->prepare($query);

    // execute the query
    $stmt->execute();

    // for fetching data to user variable from database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

   } catch (PDOException $e){
        echo "error in catch";
   }
}  

// this below code is for updating the data and showing to webpage 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    try {
        
        // for connecting to databse 
        require_once "db_connect.php";

        // selecting student_if from url using GET 
        $product_id = $_GET["product_id"];
        
        // selecting other using POST 
        $product_name = $_POST["product_name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];

        // query for updating the data 
        $query = "UPDATE products 
                  SET product_name = :product_name, 
                      category = :category, 
                      price = :price, 
                      stock = :stock 
                  WHERE product_id = :product_id";

        // this is for security perpuse 
        $stmt = $pdo->prepare($query);

        // connecting them using bind on the qury placeholder 
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":product_name",$product_name);
        $stmt->bindParam(":category",$category);
        $stmt->bindParam(":price",$price);
        $stmt->bindParam(":stock",$stock);
              
        // executing query 
        $stmt->execute();

        // sending the user to the view page 
        header("Location: view_product.php");

    } catch (Throwable $e) {
        echo "error came we are in catch mode right now";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Managment System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #0a0a0a;
            color: #e8e8e8;
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
        }

        form {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            background: #111111;
            border: 1px solid #1f1f1f;
            border-radius: 16px;
            padding: 2.5rem 2rem;
        }

        input {
            width: 100%;
            background: #0a0a0a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #e8e8e8;
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #444;
            text-transform: capitalize;
        }

        input:focus {
            border-color: #444;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.04);
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        button {
            margin-top: 0.4rem;
            width: 100%;
            padding: 0.8rem;
            background: #e8e8e8;
            color: #0a0a0a;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.1s;
        }

        button:hover {
            background: #ffffff;
        }

        button:active {
            transform: scale(0.98);
        }

        a {
            color: #0a0a0a;
            font-size: 0.9rem;
            text-decoration: none;
            letter-spacing: 0.02em;
            font-weight: 600;
            font-family: inherit;
            background: #e8e8e8;
            padding: 0.8rem;
            border-radius: 8px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            transition: background 0.2s, transform 0.1s;
            display: block;
        }

        a:hover {
            background: #ffffff;
        }

        a:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <form action="" method="post">
        <input type="text" value="<?= $user['product_name']; ?>" name="product_name" placeholder="enter name">
        <input type="text" value="<?= $user['category']; ?>" name="category" placeholder="enter category">
        <input type="number" value="<?= $user['price']; ?>" name="price" placeholder="enter price number">
        <input type="text" value="<?= $user['stock']; ?>" name="stock" placeholder="enter stock name">
        <button type="submit" name="update">Update data</button>
    </form>

    <a href="view_product.php">Back</a>

</body>
</html>