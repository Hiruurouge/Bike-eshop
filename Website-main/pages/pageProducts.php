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
                echo "<a href='signIn.php'>Connection</a>";
            else{
                $email = $_SESSION['email'];
                echo "<a href='panier.php'>Cart</a>";
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
 <section class="main">
    <h1>Our Products</h1>
    <div class=container>

        <!-- Add products from varSession.inc.php -->
        <?php
            
            
                //////////////////// Get the product page \\\\\\\\\\\\\\\\\\\\
                       
			require ("../database/db.php");
            $db = new Database();
            $db->openDB();

            $nbProducts = $db->nbProducts();			//Get the number of products

            
            
                //////////////////// For each product in the database, display it \\\\\\\\\\\\\\\\\\\\
             
            for ($i = 1; $i <= $nbProducts; $i++){          //id starts at 1
                $product = $db->getProductFromDB($i);		//Get the product $i

                
                
                    //////////////////// Get the different informations of the product \\\\\\\\\\\\\\\\\\\\
                        
			    $h1 = $product['name'];                   //Get the name of the product
                $images = $product['images'];           //Get the first image
                $price = $product['price'];             //Get the price                
                $images = explode(',', $images);        //Convert path string to array of paths
                $image = $images[0];                    //Get the first image
                
                    //////////////////// Display the product \\\\\\\\\\\\\\\\\\\\
                              
                echo "<div class=produits>
                <p><a href='product.php?product=product$i'>$h1</a></a></p>
                <img  src='$image'  onclick='enlargeImg(this)' id='img$i' alt='bike$i' height='35%' width='35%'>
             
                <button class='button' onclick=\"window.location.href='../scripts/addToCart.php?id=$i'\">Add to cart</button>
                <p>Price: $price € </p>
                </div>";

            }

            //Got products, close db
            $db->closeDB();
        ?>

        </div>
        <h1><strong>Our Accessories</strong></h1>
    <div class=container>
            <div class=produits>
            <p id="a1">Sports Bottle</p>
            <img src="../images/accesoires/bombe.jpg" alt="velo1" height="15%" width="15%">
            <p>Price: 35€</p>
        </div>
        <div class=produits>
            <p>Torque wrench</p>
            <img id="a2" src="../images/accesoires/cle.jpg" alt="velo1" height="15%" width="15%">
            <button class="button">Add to cart</button>
            <p>Price: 35€</p>

        </div>
        <div id="a3" class=produits>
            <p>Sports Bottle</p>
            <img src="../images/accesoires/gourde.jpg" alt="velo1" height="15%" width="15%">
            <button class="button">Add to cart</button>
            <p>Price: 25€</p>

        </div>
        <div id="a4" class=produits>
            <p>Swife knife</p>
            <img src="../images/accesoires/multi.jpg" alt="velo1" height="15%" width="15%">
            <button class="button">Add to cart</button>
            <p>Price: 50€</p>
        </div>
    </div>

 </section>

 </body>
 </html>