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
?>  
<!DOCTYPE html>
<html>

<head>
    <title>Grocery Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/fontawesome.min.css" rel="stylesheet">

</head>

<body>
    <!-- <div class="container"> -->
    <div class="left-hand-frame">
        <div class="header">
            <h3>GROCERY</h3>
        </div>
        <div class="secondary">
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link" href="#" id="dropdownMenuLink" data-toggle="dropdown">Frozen Food</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Hamburger Patiee</a>
                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Fish Fingers</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">600gram</a>
                                    <a class="dropdown-item" href="#">1000gram</a>
                                </div>
                            </div>

                            <a class="dropdown-item" href="#">Shelled Prawns</a>

                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Tub Ice Cream</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">1 Litre</a>
                                    <a class="dropdown-item" href="#">2 Litre</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Fresh Food</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">TBone Steak</a>
                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Cheddar Cheese</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">500gram</a>
                                    <a class="dropdown-item" href="#">1000gram</a>
                                </div>
                            </div>
                            <a class="dropdown-item" href="#">Navel Oranges</a>
                            <a class="dropdown-item" href="#">Bananas</a>
                            <a class="dropdown-item" href="#">Grapes</a>
                            <a class="dropdown-item" href="#">Apples</a>
                            <a class="dropdown-item" href="#">Peaches</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Bevarges</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Coffee</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">200gram</a>
                                    <a class="dropdown-item" href="#">600gram</a>
                                </div>
                            </div>

                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Earl Grey Tea Bags</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Pack25</a>
                                    <a class="dropdown-item" href="#">Pack100</a>
                                    <a class="dropdown-item" href="#">Pack200</a>
                                </div>
                            </div>

                            <a class="dropdown-item" href="#">Chocolate Bar</a>


                        </div>
                    </div>

                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Home Health</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Bath Soap</a>
                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Panadol Washing Powder</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Pack24</a>
                                    <a class="dropdown-item" href="#">Bottle50</a>
                                </div>
                            </div>

                            <div class="dropdown dropright">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Garbage Bags</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Small (Pack10)</a>
                                    <a class="dropdown-item" href="#">Large (Pack50)</a>
                                </div>
                            </div>

                            <a class="dropdown-item" href="#">Laundry Bleach</a>

                        </div>
                    </div>

                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Pet Food</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Bird Food</a>

                            <a class="dropdown-item" href="#">Cat Food</a>

                            <div class="dropdown dropleft">
                                <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Dry Dog Food</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">1Kg Pack</a>
                                    <a class="dropdown-item" href="#">5Kg Pack</a>
                                </div>
                            </div>
                            <a class="dropdown-item" href="#">Fish Food</a>
                        </div>
                    </div>

                </li>
            </ul>
        </div>



    </div>

    <div class="top-right-frame">
        <div class="header">
            <h3>Products</h3>
            
            <div class="row container">

                    
            <?php
                    foreach($result as $row)
                    {
                    echo '
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">                                              
                        
                            <a href="#"><img class="card-img-top" src="img\TubIceCream.jpg" alt=""></a>
                                        
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">'.$row["product_name"].'</a>
                                </h4>
                                <h5>$'.$row["unit_price"].'</h5>
                                <p class="card-text">Quantity : '.$row["unit_quantity"].' </p>
                                <p class="card-text">In-Stock : '.$row["in_stock"].'</p>
                                <input type="number" name="quantity" value="1" class="form-control" />

                            </div>
                            
                            
                            
                            <div class="card-footer">
                                <small class="pull-left">
                                    <a href="#" id="btn-standard" class="btn btn-outline-success">
                                        Add to Cart<i class="fas fa-cart-plus"></i> 
                                    </a>
                                </small>
                                
                            </div>
                        </div>
                    </div>
                    ';
                    break;
                    }
                    ?>

            </div>
        </div>
    </div>
    <div class="bottom-right-frame">
        <div class="header">
            <h3>checkout Carts</h3>
        </div>
    </div>

    <!-- Back-To-Top -->
    <a href="#" id="back-to-top" style="display: none;"><span></span></a>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/fontawesome.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    
    <!-- JS for Back To TOP -->
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 750);
                return false;
            });
        });
    </script>

</body>

</html>
