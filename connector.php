<?php
$servername = "localhost";
$username = "root";
$password = "";
$query ="SELECT * FROM `products` ORDER BY product_id ASC";

try {
    $connect = new PDO("mysql:host=$servername;dbname=poti", $username, $password);

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query($query);

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    foreach($result as $row)
    {
        echo '
        <table id="product_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Product ID</td>
                        <td>Product Name</td>
                        <td>Unit Price</td>
                        <td>Unit Quantity</td>
                        <td>In Stock</td>
                    </tr>
                </thead>
                <tbody>
            <tr>
                <td>'.$row["product_id"].'</td>
                <td>'.$row["product_name"].'</td>
                <td>'.$row["unit_price"].'</td>
                <td>'.$row["unit_quantity"].'</td>
                <td>'.$row["in_stock"].'</td>
            </tr>
        </tbody>
        </table>
        ';
    }
?>