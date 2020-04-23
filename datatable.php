<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $query ="SELECT * FROM `products` ORDER BY product_id ASC";

    try {
        $connect = new PDO("mysql:host=$servername;dbname=poti", $username, $password);

        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $connect->query($query);

        $myArray = array(); // make a new array to hold all my data

        // $index = 0;
        // while($row = $result->fetch()){ // loop to store the data in an associative array.
        //     $myArray[$index] = $row;
        //     $index++;
        // }

        // $keys   = array_keys( $myArray );
        // $values = array_values( $myArray );

        // var_dump( $keys[1] ); 
        // var_dump( $values[1] );
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Grocery Products | Home</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/fontawesome.min.css" rel="stylesheet">

    <!-- CDN for Datatable -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

</head>

<body id="page-top">


    <div class="container">
        <h1 align="center">
            Datatables Jquery Plugin with php mysql
        </h1>
        <br />
        <div class="table-responsive">
            <table id="product_data" class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Serial</td>
                        <td>Product ID</td>
                        <td>Product Name</td>
                        <td>Unit Price</td>
                        <td>Unit Quantity</td>
                        <td>In Stock</td>
                    </tr>
                </thead>
                <tbody>
                <?php
				foreach($result as $key => $row)
				{
					echo '
					
							
						<tr>
							<td>'.$key.'</td>
							<td>'.$row["product_id"].'</td>
							<td>'.$row["product_name"].'</td>
							<td>'.$row["unit_price"].'</td>
							<td>'.$row["unit_quantity"].'</td>
							<td>'.$row["in_stock"].'</td>
						</tr>
					
					
					';
				}
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; www-student.it.uts.edu.au 2020</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>
    <script src="js/fontawesome.min.js"></script>

    <!-- JS datatable -->
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#product_data').dataTable( {
            "pageLength": 15
            });
        });
    </script>

</body>

</html>
