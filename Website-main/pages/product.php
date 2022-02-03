<!DOCTYPE html>
<html lang="en"> 
	<head>
		<meta charset="utf-8">
		<meta name="authors" content="Kombila Mamboundou - Legout">
		<!-- Description site -->
		<meta name="description" content="template products pages">
		<!-- Icon site -->
		<link rel="shortcut icon" href="" type="image/x-icon">

		<!-- Page title -->
		<title>E-Biking </title>

		<!-- Add CSS stylesheet -->
		<link rel="stylesheet" type="text/css" href="../styles/stylePages.css">


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

		 <?php
			
			
				//////////////////// Get the product page \\\\\\\\\\\\\\\\\\\\

			require ("../database/db.php");
			$db = new Database();
			$db->openDB(); 							//Initialze the connection with the database
			
			$nbProducts = $db->nbProducts();			//Get the number of products

			$nb = 1;
			while ($nb <= $nbProducts && $_GET['product'] !== "product" . $nb)
				$nb++;
			

			if ($nb <= $nbProducts)		//Product page exists
				$product = $db->getProductFromDB($nb);		//Get the product associated with the page
			
			else {			
				echo "<h1>ERROR 404: Page not found<h1>";
				return;
			}
			
			
				//////////////////// Get the different informations of the product \\\\\\\\\\\\\\\\\\\\

			//$product = [name=> , images=> , ...]

			$h1 = $product['name'];
			$tabImages = $product['images'];
			$price = $product['price'];
			$shortDescription = $product['shortDescription'];
			$stock = $product['stock'];
			$advantages = $product['advantages'];
			$technicalInfos = $product['technicalInfos'];
			$productComposition = $product['productComposition'];

			
			$tabImages = explode(',', $tabImages); 		//Convert image (string "path1,path2...") to array

			
			
				//////////////////// Data has been loaded, close the db \\\\\\\\\\\\\\\\\\\\
			
			$db->closeDB();

			echo "<h1>$h1</h1>";	
		?>

		<!-- Main div: bike image, price and short description -->
		<div class="div-main"> 
			<div class="div-image-sidebar">
				<ul class="sidebar">
					<?php
						for ($j = 0; $j < count($tabImages); $j++)
						{
							$i = $j+1;
							echo "<li> <img alt='Image $i of the bike' src='$tabImages[$j]'> </li>";
						}
					?>
					<br>
					<br>
				</ul>
			</div>

			<!-- Main image div -->	
			<div class="div-imgSelected">
				<!-- Bike image selected -->
				<?php
					echo "<img class='img-selected' alt='Image selected' src='$tabImages[0]'  onclick='enlargeImg()' id='img1'/>";
				?>
				
			</div>
			
			<div class="div-description">

				<!-- Sidebar div: price and short description -->
				<?php
					echo "<p class='class-price' style='font-size:25px;'> <strong>$price €</strong></p>";
					echo "<p class='class-short-description'>$shortDescription</p>";
					echo "<button class=\"button-cart\" onclick=''> Add to cart </button>"					
				?>
				

				
				<!-- Stock button -->
 				<button class="button-stock">Stock</button>
				<?php
					echo "<p class='p-stock'><strong>$stock</strong></p>";
					echo "
					<form class='form-quantity' style='margin-left:950px; margin-top: 10px; ; visibility: hidden; height:30px; border:none;' method='post' action=''>
						<label for='p-cartQuantity' class='p-quantity'>Quantity: </label>
						<input type='number' class='p-cartQuantity' name='p-cartQuantity' style='width: 40px;' min='0' max='$stock' value='0'>
						<input type='submit' class='valider' name='valider' style='cursor: pointer; background-color:rgb(0, 101, 119); color: white; text-decoration: none; border:none; margin-left: 14%; width:60px; height:30px; margin-top: -7px;' value='Add'>
					</form>
					";

						//////////////////// Quantity modified => update session var \\\\\\\\\\\\\\\\\\\\

					@$quantity = $_POST['p-cartQuantity'];		//Get quantity 
					@$validate = $_POST['valider'];
					if (isset($validate)){
						if (empty($_SESSION['email']))
							echo "<script type='text/javascript'>alert('Error: You must connect to add to your cart')</script>";
						else {
							if ($quantity != 0){

							/* $_SESSION['cart'] is an array of [id, nb] where i such as $_SESSION['cart'][i] is id-1 */
							$_SESSION['cart'][$nb-1][1] = $quantity;
							}
						}
					}
				?>

			</div>

		
		</div>	

		<!-- Advantages div -->
		<div class="div-advantages"> 
			<h2> Product benefits </h2>

			<?php 
				echo "<p class='class-benefits'>$advantages</p>";
			?>
			
		</div>

		<!-- Technical information div -->
		<div class="div-technical-information">
			<h3> Technical information </h3>

			<?php 
				echo "<p class='class-technical-information'>$technicalInfos</p>";
			?>

		</div>

		<!-- Features div -->
		<div class="div-features">
			<h4> Product concept and technology </h4>

			<?php 
				echo "<p class='class-product-concept'>$productComposition</p>";
			?>
			
		</div>
	

	</body>
	




	<!-- Add Javascript script  -->
	<script type="text/javascript" src="../scripts/main.js"></script>
</html>
