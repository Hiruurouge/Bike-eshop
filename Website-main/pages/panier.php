<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css" />
    <title> Ebiking </title>

</head>

<body>
 <header class="header">
    <div class="header">
        <a href="../index.php" class="logo">E-Biking</a>
        <div class="header-right">
        <?php
            session_start();
            if (empty($_SESSION['email']))
               echo "<script type='text/javascript'> alert('Error: you must connect to add to your cart'); setTimeout(function(){ window.history.back(); }, 0);</script>";
            else{
                $email = $_SESSION['email'];
                echo "<a href='../scripts/disconnection.php'>$email</a>";
            }           
          ?>
          <a class href="../index.php">Home</a>
          <a href="../index.php#contact">Contact</a>
          <a class="active" href="pageProducts.php">Products</a>
        </div>
      </div>
    <div class="trait"></div>

 </header>

 <body>
 <h1 style="text-align: center; color: dodgerblue; font-size: 40px;">Your Cart</h1>
    <div class="div-cart">
         <?php
            require("../database/db.php");
            $db = new Database();
            $db->openDB();
            $nbProductCart = 0;
            $totalPrice = 0;
            foreach($_SESSION['cart'] as $product){
               //$product = [idProduct, nbProduct]

               if ($product[1] != 0){     //Has been added to cart 
                  $nbProductCart++;

                                 
                     //////////////////// Get product infos from database \\\\\\\\\\\\\\\\\\\\

                 
                  $infoProduct = $db->getProductFromDB($product[0]);
                  
                  $name = $infoProduct['name'];
                  $price = $infoProduct['price'];
                  $images = $infoProduct['images'];
                  $images = explode(',', $images);
                  $image = $images[0];             //Get the main image of the product

                  $totalPrice += $price * $product[1];
                  
                     //////////////////// Display its informations \\\\\\\\\\\\\\\\\\\\
                  
                  echo "
                  <div class='div-product'>
                     <img src='$image' alt='Product $nbProductCart image' style='float: left; width:100px; max-height:100px;border-radius:8px; margin-left: 70px; marggin-top:10px;'>
                     <p style='float: left; margin-left:80px; margin-top: 30px;'>$name</p>
                     <div class='price-quantity'>
                        <p style='float: left; margin-left:50px; margin-top:30px; position: absolute;'><strong>$price €</strong></p>
                        <p style='float: left; margin-left:150px;margin-top:30px;position: absolute; '>Quantity: $product[1]</p>
                        <button type='button' class='button-supp' onclick=\"window.location.href='../scripts/updateCart.php?id=$product[0]'\" >X</button>
                     </div>
                  </div>";
                  
               }
            }

            if ($nbProductCart == 0){
               echo "<h1 style='text-align: center;'>Your cart is empty</h1>";
            }
            else{
               echo "
               <p class='p-totalPrice'>Total: <strong>$totalPrice €</strong></p>
               <button type='button' class='button-cart' onclick=\"window.location.href='../scripts/updateCart.php?id=0'\">Validate cart</button>";
            }
            $db->closeDB();
         ?>
    </div>
 </body>
 </html>