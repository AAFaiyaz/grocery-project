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

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd;" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">Grocery Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

            <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="bounceIn fadeInLeft fadeInUp bounceIn" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#page-top">Home
                        <span class="sr-only">(current)</span>
                      </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Groceries
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Frozen Food</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Hamburgers Patties</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Fish Fingers</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">500 Gram</a></li>
                                            <li><a class="dropdown-item" href="#">1000 Gram</a></li>
                                        </ul>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Shelled Prawns</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Tub Ice Cream</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">1 litre</a></li>
                                            <li><a class="dropdown-item" href="#">2 litre</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Fresh Food</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">T'Bone Steak</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Chedder Cheese</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">500 Gram</a></li>
                                            <li><a class="dropdown-item" href="#">1000 Gram</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Navel Oranges</a></li>
                                    <li><a class="dropdown-item" href="#">Bananas</a></li>
                                    <li><a class="dropdown-item" href="#">Grapes</a></li>
                                    <li><a class="dropdown-item" href="#">Apples</a></li>
                                    <li><a class="dropdown-item" href="#">Peaches</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Beverages</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Coffee</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">200 Gram</a></li>
                                            <li><a class="dropdown-item" href="#">500 Gram</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Earl Grey Tea Bags</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Pack 25</a></li>
                                            <li><a class="dropdown-item" href="#">Pack 100</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Chocolate Bar</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Home Health</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Bath Soap</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Panadol</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Pack 24</a></li>
                                            <li><a class="dropdown-item" href="#">Bottle 50</a></li>
                                        </ul>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Washing Powder</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Garbage Bags</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">small (pack 25)</a></li>
                                            <li><a class="dropdown-item" href="#">large (pack 50)</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Laundry Bleach</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Pet Food</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Bird Food</a></li>
                                    <li><a class="dropdown-item" href="#">Cat Food</a></li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Dry Dog Food</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">1 kg. Pack</a></li>
                                            <li><a class="dropdown-item" href="#">5 kg. Pack</a></li>
                                        </ul>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Fish Food</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-info my-2 my-sm-0 btn-margin-left" type="submit">Search</button>
                </form>
                <button type="button" class="btn btn-outline-dark btn-margin-right" data-toggle="modal" data-target="#cartModal">
                    View Cart <i class="fas fa-shopping-cart"></i></button>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <section id="products">
        <div class="container">

            <div class="row">

                <div class="col-sm-2 sidebar">

                    <h1 class="my-4">Products</h1>
                    <div class="list-group">
                        <a href="#" class="list-group-item">Frozen Food</a>
                        <a href="#" class="list-group-item">Fresh Food</a>
                        <a href="#" class="list-group-item">Beverage</a>
                        <a href="#" class="list-group-item">Home Health</a>
                        <a href="#" class="list-group-item">Pet Food</a>
                    </div>

                </div>
                <!-- /.col-lg-2 -->

                <div class="col-lg-8 middle-section">

                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="img\pic4.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="img\pic2.jpg" alt="Sencond slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="img\pic3.png" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="row">

                    
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
                                </div>
                                
                                
                                
                                <div class="card-footer">
                                    <small class="pull-left">
                                        <a href="#" id="btn-standard" class="btn btn-outline-success">
                                            Add <i class="fas fa-cart-plus"></i> 
                                        </a>
                                    </small>
                                    <small class="pull-right">
                                        <a href="#" class="btn btn-warning">
                                            Cart <i class="fas fa-shopping-bag"></i> 
                                        </a>
                                </small>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                        ?>
                    
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.col-lg-8 -->

                <div class="col-sm-2 checkout-section">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$5</span>
                        </li>
                        <!-- <li class="list-group-item d-flex justify-content-between bg-light">
                          <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                          </div>
                          <span class="text-success">-$5</span>
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.row -->

        </div>
    </section>
    <!-- /.container -->

    <section id="services" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Online Grocery Shopping Australia Offers</h2>
                    <p>Nowadays the internet has become the best way to do your shopping, but is also the best source of information. Shopping online can truly find you anything you want. is now becoming more popular as it is not only very convenient but
                        also quite easy and flexible.&nbsp;</p>

                    <h2><strong></strong>Saving Time and Energy</h2>
                    <p>When going to visit your local supermarket, there is always that chance of waiting in very long lines before being served. These days most peoples time is very significant, especially for those who work and have busy schedules. Shopping
                        online is proven to save more time, then going to the local stores to shop for your food. All that's required is to spend a few minutes on your computer or laptop o complete your list.&nbsp;</p>
                    <h3>Fast Delivery</h3>
                    <p>One of the best things about shopping online is having your goods delivered direct to your doorstep quickly and conveniently. This is ideal for anyone who is a working mother or with a busy schedule. You can choose to order your groceries
                        from your home or office with Harris Farm Markets.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Your Shopping Cart
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                </div>
                <div class="modal-body">
                    <table class="table table-image" id="productFinal">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-25">
                                    <img src="img/instantcoffee.jpg" class="img-fluid img-thumbnail" alt="Sheep">
                                </td>
                                <td>Instant Coffee</td>
                                <td>89$</td>
                                <td class="qty"><input type="number" class="form-control product_quantity" id="product_quantity" value="1"></td>
                                <td>89$</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm btnDelete">
                                        <i class="fas fa-lg fa-window-close"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <h5>Total: <span class="price text-success">89$</span></h5>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Aleart -->
    <div class="alert-container">
        <div class="alert-custom">
            Product has been added to list.
        </div>
    </div>

    <!-- Back-To-Top -->
    <a href="#" id="back-to-top" style="display: none;"><span></span></a>

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

    <!-- Plugin JavaScript -->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>
    <script src="js/fontawesome.min.js"></script>

    <!-- Shopping Cart JS -->
    <script>
        $('#cartModal').click(function() {
            $('#cartModal').modal('show');
        });

        $(document).ready(function() {

            $("#productFinal").on('click', '.btnDelete', function() {
                $(this).closest('tr').remove();
                $('#cartModal').modal('hide');
            });

        });
    </script>

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

    <!-- JS for product alert -->
    <script>
        $(document).ready(function() {
            var alert = $(".alert-container");

            alert.hide();

            $("#btn-standard").click(function(e) {
                e.preventDefault();
                alert.slideDown();
                window.setTimeout(function() {
                    alert.slideUp();
                }, 2500);
            });
        });
    </script>

</body>

</html>
