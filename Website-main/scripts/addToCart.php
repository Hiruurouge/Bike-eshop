<?php
    session_start();
    if (empty($_SESSION['email'])){
        echo "<script type='text/javascript'>alert('Error: You must connect to add to your cart'); setTimeout(function(){ window.history.back(); }, 0);</script>";
    }
       
    else {
        $id = $_GET['id'];

    
            //////////////////// Update quantity = 1 for the product associated with id \\\\\\\\\\\\\\\\\\\\
    
        $_SESSION['cart'][$id-1][1] = 1;
        echo "<script type='text/javascript'>setTimeout(function(){ window.history.back(); }, 0);</script>";
    }
    
?>