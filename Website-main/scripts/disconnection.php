<?php
    session_start();
    session_destroy();  //Destroy the user session
    header('Location: ../index.php');   //redirect to the main page
?>