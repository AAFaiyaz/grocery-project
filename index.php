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
                <?php
                $myquery ="SELECT * FROM products WHERE product_name ='Hamburger Patties'";
                $statement = $connect->prepare($myquery);
                $statement->execute();
                $hamburger = $statement->fetchAll();
                foreach($hamburger as $key => $row)
                {
                ?>
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>                        

                <?php
                $myquery ="SELECT * FROM products WHERE product_name ='Shelled Prawns'";
                $statement = $connect->prepare($myquery);
                $statement->execute();
                $Prawns = $statement->fetchAll();
                foreach($Prawns as $key => $row)
                {
                ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                <?php
                    $myquery ="SELECT * FROM products WHERE product_name ='Tub Ice Cream'";
                    $statement = $connect->prepare($myquery);
                    $statement->execute();
                    $Fish = $statement->fetchAll();
                    foreach($Fish as $key => $row)
                    {
                ?>
                        <div class="dropdown ">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>

                <?php
                    $myquery ="SELECT * FROM products WHERE product_name ='Fish Fingers'";
                    $statement = $connect->prepare($myquery);
                    $statement->execute();
                    $Fish = $statement->fetchAll();
                    foreach($Fish as $key => $row)
                    {
                ?>
                        <div class="dropdown dropright">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>
                        
                    </div>
                </div>
            </li>
            <!-- End this Nav Item -->

            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Fresh Food</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        <!-- <a class="dropdown-item" href="#">T Bone Steak</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='T Bone Steak'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Steak = $statement->fetchAll();
                        foreach($Steak as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                                                                    
                        <!-- <a class="dropdown-item" href="#">Navel Oranges</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Navel Oranges'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Oranges = $statement->fetchAll();
                        foreach($Oranges as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <!-- <a class="dropdown-item" href="#">Bananas</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Bananas'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Bananas = $statement->fetchAll();
                        foreach($Bananas as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <!-- <a class="dropdown-item" href="#">Grapes</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Grapes'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Grapes = $statement->fetchAll();
                        foreach($Grapes as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <!-- <a class="dropdown-item" href="#">Apples</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Apples'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Apples = $statement->fetchAll();
                        foreach($Apples as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                        
                        <!-- <a class="dropdown-item" href="#">Peaches</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Peaches'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Peaches = $statement->fetchAll();
                        foreach($Peaches as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                            $myquery ="SELECT * FROM products WHERE product_name ='Cheddar Cheese'";
                            $statement = $connect->prepare($myquery);
                            $statement->execute();
                            $Cheese = $statement->fetchAll();
                            foreach($Cheese as $key => $row)
                            {
                        ?>
                        <div class="dropdown ">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>
                        <!-- End this Nav Item -->

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Bevarges</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        <?php
                            $myquery ="SELECT * FROM products WHERE product_name ='Instant Coffee'";
                            $statement = $connect->prepare($myquery);
                            $statement->execute();
                            $Coffee = $statement->fetchAll();
                            foreach($Coffee as $key => $row)
                            {
                        ?>
                        <div class="dropdown ">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>

                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Chocolate Bar'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Chocolate = $statement->fetchAll();
                        foreach($Chocolate as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropleft">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                            $myquery ="SELECT * FROM products WHERE product_name ='Earl Grey Tea Bags'";
                            $statement = $connect->prepare($myquery);
                            $statement->execute();
                            $Earl = $statement->fetchAll();
                            foreach($Earl as $key => $row)
                            {
                        ?>
                        <div class="dropdown dropright">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>
                        <!-- End this Nav Item -->

                    </div>
                </div>

            </li>

            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Home Health</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <!-- <a class="dropdown-item" href="#">Bath Soap</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Bath Soap'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Soap = $statement->fetchAll();
                        foreach($Soap as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                       
                        <!-- <a class="dropdown-item" href="#">Laundry Bleach</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Laundry Bleach'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Laundry = $statement->fetchAll();
                        foreach($Laundry as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                    
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Garbage Bags Small'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $GBsmall = $statement->fetchAll();
                        foreach($GBsmall as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Garbage Bags Large'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $GBlarge = $statement->fetchAll();
                        foreach($GBlarge as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[2]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Washing Powder'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Washing = $statement->fetchAll();
                        foreach($Washing as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropright">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[1]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                            $myquery ="SELECT * FROM products WHERE product_name ='Panadol'";
                            $statement = $connect->prepare($myquery);
                            $statement->execute();
                            $Panadol = $statement->fetchAll();
                            foreach($Panadol as $key => $row)
                            {
                        ?>
                        <div class="dropdown">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php echo $row["product_name"]; ?>"
                                aria-expanded="false" aria-controls="<?php echo $row["product_name"]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>
                        <!-- End this Nav Item -->

                    </div>
                </div>

            </li>

            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">Pet Food</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <!-- <a class="dropdown-item" href="#">Bird Food</a> -->
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Bird Food'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Bird = $statement->fetchAll();
                        foreach($Bird as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropleft">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>

                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Cat Food'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Cat = $statement->fetchAll();
                        foreach($Cat as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropleft">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Dry Dog Food'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Dog = $statement->fetchAll();
                        foreach($Dog as $key => $row)
                        {
                        ?>
                        <div class="dropdown dropright">
                        <?php if($key==0){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            <?php }?>
                            <?php if($key==1){?>
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                          <?php }}?>
                        </div>
                        
                        <?php
                        $myquery ="SELECT * FROM products WHERE product_name ='Fish Food'";
                        $statement = $connect->prepare($myquery);
                        $statement->execute();
                        $Fish = $statement->fetchAll();
                        foreach($Fish as $key => $row)
                        {
                        ?>
                                                
                        <div class="dropdown dropleft">
                        <?php if($key < 1){?>
                        <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                        <?php echo $row["product_name"]; ?>
                        </a>
                        <?php }?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="javascript::void" 
                                data-toggle="collapse" data-target="#<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>"
                                aria-expanded="false" aria-controls="<?php $pieces = explode(" ", $row["product_name"]); echo $pieces[0]; ?>">
                                    <?php echo $row["unit_quantity"]; ?>
                                </a>
                            </div>
                        <?php }?>
                        </div>
                        <!-- end product -->
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
                <?php if($row){ ?>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="collapse" 
                    id="<?php 
                    if(strpos($row['product_name'], ' ') !== false) {
                        // explodable
                        $pieces = explode(" ", $row["product_name"]); 
                        if($pieces[1] =='')
                        { 
                            echo $row["product_name"]; 
                        }                        
                        elseif ($pieces[1] !='')
                        {
                            if ( isset($pieces[1]) && $pieces[1]== 'Food' ){
                                echo $pieces[0]; 
                            }elseif ( isset($pieces[2]) && $pieces[2]!= 'Food'){
                                echo $pieces[2]; 
                            }elseif ( isset($pieces[2]) && $pieces[2]== 'Food'){
                                echo $pieces[0]; 
                            }elseif ( !isset($pieces[2]) ){
                                echo $pieces[1]; 
                            }
                            else{}

                        }else{}     
                    } else {
                        echo $row["product_name"]; 
                    }                                
                    ?>">

                        <div class="card h-100">

                        <a href="#"><img class="card-img-top" src="img\<?php echo $row["product_name"]?>.jpg" alt=""></a>

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
            <h3>Checkout Cart</h3>
            <div class="table-responsive">
                <?php echo $message; ?>
                <!-- <div align="right">
                    <a href="index.php?action=clear" class="btn btn-info"><b>Clear Cart</b></a>
                </div> -->
                <br/>
                <table class="table table-bordered table-dark">
                  <thead>
                    <tr>
                    <th width="25%">Item Name</th>
                    <th width="10%">In Stock</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                    </tr>
                  </thead>
                <?php
                if(isset($_COOKIE["shopping_cart"]))
                {
                    $productName="";
                    $inStock="";
                    $unitPrice="";
                    $totalEachProduct="";
                    $totalAllProduct="";

                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    foreach($cart_data as $keys => $values)
                    {
                ?>
                <tbody>
                    <tr>
                    <td><?php echo $values["product_name"]; $productName=$values["product_name"]; ?></td>
                    <td><?php echo $values["in_stock"]; $inStock=$values["in_stock"]; ?></td>
                    <td>$ <?php echo $values["unit_price"]; $unitPrice=$values["unit_price"]; ?></td>
                    <td>$ <?php echo number_format($values["in_stock"] * $values["unit_price"], 2); $totalEachProduct=number_format($values["in_stock"] * $values["unit_price"], 2); ?></td>
                    <td><a href="index.php?action=delete&id=<?php echo $values["product_id"]; ?>" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                <?php
                    $total = $total + ($values["in_stock"] * $values["unit_price"]);
                    }
                ?>
                    <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); $totalAllProduct=number_format($total, 2); ?></td>
                    <td></td>
                    </tr>

                </tbody>

                <?php
                    // For SENDING EMAIL
                    if (isset($_POST['sendmail'])) {

                        require 'PHPMailerAutoload.php';
                        require 'credential.php';

                        $mail = new PHPMailer;

                        // $mail->SMTPDebug = 4;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = EMAIL;                 
                        // SMTP username
                        $mail->Password = PASS;                           
                        // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom(EMAIL, 'Testing Mail Service');
                        $mail->addAddress($_POST['email']);     
                        // Name is optional
                        $mail->addReplyTo(EMAIL);
                        

                        // Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    
                        // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Recipt Grocery Products List';
                                                
                        $mail->Body    = 
                        '
                        <h2>Recipt Grocery Products List</h2>
                        <table class="table table-bordered table-dark">
                        <thead>
                          <tr>
                          <th width="25%">Item Name</th>
                          <th width="10%">In Stock</th>
                          <th width="20%">Price</th>
                          <th width="15%">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>'. $productName .  '</td>
                            <td> '. $inStock .  ' </td>
                            <td>$ '. $unitPrice .  ' </td>
                            <td>$ '. $totalEachProduct .  ' </td>
                            </tr>
                            <tr>
                            <td colspan="3" align="right">Total</td>
                            <td align="right">$ '. $totalAllProduct.  ' </td>
                            <td></td>
                            </tr>
                        </tbody>
                        </table>
                        '
                        ;
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        if(!$mail->send()) {
                            echo '
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Email failed to sent!
                            </div>';
                            // echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo '
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Email has been sent.
                            </div>';
                        }
                    }
                    // ending SENDING EMAIL

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
                <div>
                    <div align="right">
                        <a data-toggle="collapse" href="#collapseExample" class="btn btn-dark">Proceed</a>
                        <a href="index.php?action=clear" class="btn btn-info"><b>Clear Cart</b></a>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label style="float: left" class="control-label label col-auto" for="uname">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="uname" placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="float: left" class="control-label label col-auto" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="float: left" class="control-label label col-auto" for="address">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" placeholder="Enter Your Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="float: left" class="control-label label col-auto" for="suburb">Suburb:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="suburb" placeholder="Enter Your Suburb">
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="float: left" class="control-label label col-auto" for="state">State:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="state" placeholder="Enter Your Address">
                                </div>
                            </div>                                                        
            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="sendmail" class="btn btn-funky">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                                
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
