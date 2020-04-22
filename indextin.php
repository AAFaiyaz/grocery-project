<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $query ="SELECT * FROM products ORDER BY product_id ASC";

    try {
        $connect = new PDO("mysql:host=$servername;dbname=poti", $username, $password);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    $message = '';

    if(isset($_POST["add_to_cart"]))
    {
    if(isset($_COOKIE["shopping_cart"]))
    {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);

    $cart_data = json_decode($cookie_data, true);
    }
    else
    {
    $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'product_id');

    if(in_array($_POST["hidden_id"], $item_id_list))
    {
        foreach($cart_data as $keys => $values)
        {
            if($cart_data[$keys]["product_id"] == $_POST["hidden_id"])
            {
                $cart_data[$keys]["in_stock"] = $cart_data[$keys]["in_stock"] + $_POST["quantity"];
            }
        }
    }
    else
    {
        $item_array = array(
            'product_id'   => $_POST["hidden_id"],
            'product_name'   => $_POST["hidden_name"],
            'unit_price'  => $_POST["hidden_price"],
            'unit_quantity'  => $_POST["hidden_quantity"],
            'in_stock'  => $_POST["quantity"]
        );
        $cart_data[] = $item_array;
    }

    
    $item_data = json_encode($cart_data);

    $cookie_data = $myArray;
    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:index.php?success=1");
    }

    if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['product_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:index.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:index.php?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}

?> 
<!DOCTYPE html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $key => $row)
                    {
                    ?>
                    <?php if($row["product_name"] == "Fish Fingers") 
                    {?>
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">                                              

                            <a href="#"><img class="card-img-top" src="img\FishFingers.jpg" alt=""></a>
                            <form method="post">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?php echo $row["product_name"]; ?></a>
                                </h4>
                                <h5>$ <?php echo $row["unit_price"]; ?></h5>
                                <p class="card-text">Quantity : <?php echo $row["unit_quantity"]; ?></p>
                                <p class="card-text">In-Stock : <?php echo $row["in_stock"]; ?></p>
                                
                                <input type="number" name="quantity" value="1" class="form-control" />
                                <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
                                <input type="hidden" name="hidden_price" value="<?php echo $row["unit_price"]; ?>" />
                                <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
                            </div>                            
                                                        
                            <div class="card-footer">
                                <small class="container">
                                    <input type="submit" name="add_to_cart" style="margin-top:5px;" 
                                    class="btn btn-outline-success btn-standard" value="Add to Cart" />
                                </small>
                                
                            </div>
                            </form>
                        </div>
                    </div>

                    
                    <?php }else{?>
                    <!-- Else OR NOimage part  -->

                    <?php
                    }
                    // break;
                    }
                    ?>

            </div>
        </div>
    </div>
    <div class="bottom-right-frame">
        <div class="header">
            <h3>checkout Carts</h3>
            <div class="table-responsive">
                <?php echo $message; ?>
                <div align="right">
                    <a href="index.php?action=clear"><b>Clear Cart</b></a>
                </div>
                <table class="table table-bordered">
                    <tr>
                    <th width="25%">Item Name</th>
                    <th width="10%">In Stock</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                    </tr>
                <?php
                if(isset($_COOKIE["shopping_cart"]))
                {
                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    foreach($cart_data as $keys => $values)
                    {
                ?>
                    <tr>
                    <td><?php echo $values["product_name"]; ?></td>
                    <td><?php echo $values["in_stock"]; ?></td>
                    <td>$ <?php echo $values["unit_price"]; ?></td>
                    <td>$ <?php echo number_format($values["in_stock"] * $values["unit_price"], 2);?></td>
                    <td><a href="index.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                    </tr>
                <?php 
                    $total = $total + ($values["in_stock"] * $values["unit_price"]);
                    }
                ?>
                    <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                    </tr>
                <?php
                }
                else
                {
                    echo '
                    <tr>
                    <td colspan="5" align="center">No Item in Cart</td>
                    </tr>
                    ';
                }
                ?>
                </table>
                </div>
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
