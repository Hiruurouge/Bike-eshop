<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css" />
    <title> Ebiking </title>

</head>

<body>
 <header class="header">
    <div class="header">
        <a href="#default" class="logo">E-Biking</a>
        <div class="header-right">
          <?php
            session_start();
            if (empty($_SESSION['email']))
                echo "<a href='pages/signIn.php'>Connection</a>";
            else{
                $email = $_SESSION['email'];
                echo "<a href='pages/panier.php'>Cart</a>";
                echo "<a href='scripts/disconnection.php'>$email</a>";
            }           
          ?>         
          <a class="active" href="#home">Home</a>
          <a href="#contact">Contact</a>
		 <a href="pages/pageProducts.php">Products</a>
        </div>
      </div>
    <div class="trait"></div>

 </header>
  <article class="main">
    <div class="box">
        <div class="vente" > 
        <h1>Top Sales Bikes</h1>
        <div class="image-grid">
            <figure>
                <img class="grid-image" id="img1" src="images/bike_1/image1" width="320px" height="240px"/>
                <figcaption><a href="pages/product.php?product=product1">Bike 1</a></figure>
            </figure>
            <figure>
                <img class="grid-image" src="images/bike_2/image1" width="320px" height="240px"/>
                <figcaption><figcaption><a href="pages/product.php?product=product2">Bike 2</a></figure></figure>

            </figure>
            <figure>
                <img class="grid-image" src="images/bike_3/image1" width="320px" height="240px"/>
                <figcaption><figcaption><a href="pages/product.php?product=product3">Bike 3</a></figure></figure>
            </figure>
            <figure>
                <img class="grid-image" src="images/bike_4/image1" width="320px" height="240px"/>
                <figcaption><figcaption><a href="pages/product.php?product=product4">Bike 4</a></figure></figure>
            </figure>
        
        </div>

        </div>
        <div class="Pro" > 
            <h1>Top Sales Accessories</h1>
            <div class="image-grid">
                <figure>
                    <img class="grid-image" src="images/accesoires/bombe.jpg" width="320px" height="240px"/>
                    <figcaption><a href="pages/pageProducts.php#a1">Accessory 1</a></figure>
                </figure>
                <figure>
                    <img class="grid-image" src="images/accesoires/cle.jpg" width="320px" height="240px"/>
                    <figcaption><a href="pages/pageProducts.php#a2">Accessory 2</a></figure>

    
                </figure>
                <figure>
                    <img class="grid-image" src="images/accesoires/gourde.jpg" width="320px" height="240px"/>
                    <figcaption><a href="pages/pageProducts.php#a3">Accessory 3</a></figure>

                </figure>
                <figure>
                    <img class="grid-image" src="images/accesoires/multi.jpg" width="320px" height="240px"/>
                    <figcaption><a href="pages/pageProducts.php#a4">Accessory 3</a></figure>
                </figure>
            
            </div>
            
            </div>
        </div>
        </div>
    </div>

</article>
    <footer class = "footer">
        <h1>Contact us</h1>
    	<form action="" method="post" id="contact">
    <div>
        <label for="name">Name :</label>
        <input type="text" id="name" name="name">
        <br>
        <span id="Error"></span>
        </br>
    </div>
    <div>
        <label for="mail">e-mail :</label>
        <input type="email" id="mail" name="email">
        <br>
        <span id="Error2"></span>
        </br>
    </div>
    <div>
        <label for="msg">Message :</label>
        <textarea id="msg" name="message"></textarea>
        <br>
        <span id="Error3"></span>
        </br>
    </div>
    <div class="button">
        <button type="submit">Send message</button>
    </div>
    <?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($message)) {
        $errors[] = 'Message is empty';
    }


    if (empty($errors)) {
        $toEmail = 'jolmamboundou@gmail.com';
        $emailSubject = 'New email from your contant form';
        $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
        $body = join(PHP_EOL, $bodyParagraphs);

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            echo "Thanks you!";
        } else {
            $errorMessage = 'Oops, something went wrong. Please try again later';
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
}

?>
</form>
<script>
    let myform = document.getElementById('contact');
    let myRegex = /^[a-zA-Z-\s]+$/;
     myform.addEventListener('submit',function(e)
    {
        let myinput=document.getElementById('name');
        let mymail = document.getElementById('mail');
        let mymsg = document.getElementById('msg');
        if(myinput.value.trim()=="")
        {
            let myError=document.getElementById('Error');
            myError.innerHTML="Field requiered";
            myError.style.color='red';
            e.preventDefault();
        } 
       else if(myRegex.test(myinput.value)==false)
        {
            let myError=document.getElementById('Error');
            myError.innerHTML="Can only contains letters";
            myError.style.color='red';
            e.preventDefault();
        } 
        if (mymail.value.trim()=="")
        {
            let myError2=document.getElementById('Error2');
            myError2.innerHTML="Field requiered";
            myError2.style.color='red';
            e.preventDefault();
        }
        if (mymsg.value.trim()=="")
        {
            let myError3=document.getElementById('Error3');
            myError3.innerHTML="Field requiered";
            myError3.style.color='red';
            e.preventDefault();
        }
        });
</script>

<p>All Right Reserved</p>
    </footer> 
</body>
</html>