<?php
    session_start();
    $id = $_GET['id'];

    
        //////////////////// Reset quantity for the product associated with id \\\\\\\\\\\\\\\\\\\\

    if ($id != 0){
        $_SESSION['cart'][$id-1][1] = 0;
    echo "<script type='text/javascript'>setTimeout(function(){ window.history.back(); }, 0);</script>";
    }
    
    
        //////////////////// Validate cart => modify stock \\\\\\\\\\\\\\\\\\\\
    
    else{
        require("../database/db.php");
        $db = new Database();
        $db->openDB();

        foreach($_SESSION['cart'] as $product){
            if ($product[1] != 0){          //has been bought
                $db->setStock($product[0], $product[1]);        //Modify stock
                $_SESSION['cart'][$product[0]-1][1] = 0;        //reset cart
            }
        }

        $db->closeDB();

        echo "<script type='text/javascript'>alert('Your order has been taken into account. You will receive an email with the recap of your order and a link to follow your parcel') ; setTimeout(function(){ window.location.href='../index.php' },0);</script>";
    }
?>