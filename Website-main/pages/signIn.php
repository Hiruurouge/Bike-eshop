<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylePages.css" />
    <title> Ebiking </title>

</head>

<body>
 <header class="header">
    <div class="header">
        <a href="../index.php" class="logo">E-Biking</a>
        <div class="header-right">
          <a class href="../index.php">Home</a>
          <a href="../index.php#contact">Contact</a>
          <a class="active" href="pageProducts.php">Products</a>
        </div>
      </div>
    <div class="trait"></div>

 </header>
    <div class="div-form">
		<h1>Authentification</h1>
		<form method="post" action="" style="width:700px; height: 300px; margin-top: 50px;">

			<div class="div-left">
				<label style="margin-top: 50px; width: 300px;" for="email">Your email: </label>
				<label style="margin-top: 100px; width: 300px;" for="password"  >Your password: </label>
			</div>

			<div class="div-right" >
				<input style="margin-top: 50px;" type="email" name="email" id="email" placeholder="Type your email">
				<input style="margin-top: 90px;" type="password" name="password" id="password"  placeholder="Type your password">
			</div>


            <!-- Display an error message if at least one of the fields is empty when the connection button is clicked -->
			<?php
				require("../database/db.php");

				/* Submit informations */
				/* Get the informations filled up by the user */
				@$email = $_POST['email'];
				@$password = $_POST['password'];
				@$validate = $_POST['valider'];
				$message = "";					//Message that will be displayed if at least one of the fields is empty

				/* If validate button is clicked */
				if (isset($validate)){
					if (!empty($email) && !empty($password)) {

						/* Connection to the database */ 
						$db = new SQLite3("../database/db.sql");
								
						/* Get informations in the database */
						$results = $db->query("SELECT email, password FROM Users WHERE email = '$email'");

						$row = $results->fetchArray();
						if ($email === $row['email'] && password_verify($password, $row['password'])){

								
							/* Create session variable to get the email address and therefore get all the informations in the connected page thanks to the database */
							session_start();
							$_SESSION['email'] = $email;
							
							
							
								//////////////////// Initialize Cart as a session variable \\\\\\\\\\\\\\\\\\\\
							
							
							/* Create a session variable as an array initialized as [[1,0], [2,0] ...] <=> [[idProduct, quantityProduct]]. When the user add a product to its cart, update quantityProduct for the associated idProduct */
							$_SESSION['cart'] = array();

							$db = new Database();
							$db->openDB();
							$nbProducts = $db->nbProducts();
							$db->closeDB();

							for ($i = 1; $i <= $nbProducts; $i++)
								array_push($_SESSION['cart'], [$i, 0]);


							/* Redirect to the home page */
							header('Location: ../index.php');
						}
						/* If informations are not accurates => display an error message */
						else 
							$message = "Error, wrong password or email";

						$db->close();			//close the database
				
					}
					else{		/* Fields empty */
						$message = 'You must fill in every field to connect';
					}
				} 

				/* Then, display message */
				echo "<p class='p-emptyFields' style='color: red; text-align: center; height: 5px; font-size: 18px; margin-top: 190px; padding-bottom: 0px; margin-bottom: 5px;'>" .$message ."</p>";
			?>

			<input class="valider" style="cursor: pointer; width: 90px; border-radius: 5px; border: 0.5px solid grey; height: 30px; float:right; font-size: 15px; font-family: inherit; background-color: #f3f3f3; margin-top: 60px;" type="submit" name="valider" value="Connect">
            <button class="button-cancel" onclick="window.location.href='../index.php'" style="cursor: pointer; margin-top: 60px; margin-left:200px; border: 0.5px solid grey; width: 90px; height: 30px; border-radius: 5px; font-size: 15px; font-family: inherit; background-color: #f3f3f3;" >Cancel</button>
			
		</form>

		

		

	</div>


	<!-- Add Javascript script  -->
	<script type="text/javascript" src="../scripts/signIn.js"></script>
 </body>