<?php
/**
 * This script get the informations of the products from a json file and insert them into a database
 */

        
            //////////////////// Get data for each product from json file \\\\\\\\\\\\\\\\\\\\
        
    $jsonContent = file_get_contents("produit.json");
    $data = json_decode("[". substr($jsonContent, 0, -1)."]");



        
        
            //////////////////// Connect to the database \\\\\\\\\\\\\\\\\\\\      

    require ("db.php");
    $db = new Database();
    $pdo = $db->openDB();

    echo "\nProcessing...\n";


        
        
            //////////////////// For each product, insert values into the database \\\\\\\\\\\\\\\\\\\\
        
    foreach ($data as $product){
        echo "...\n";
        //$product->tabImages is an array, transform it into a string. Each path is separated by a comma
        $tabImages = implode(',' ,$product->tabImages);
       
        //Prepare query
        $res = $pdo->prepare("INSERT INTO Products (`name`, images, price, shortDescription, stock, advantages, technicalInfos, productComposition) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        //Then execute it
        $res->execute([$product->name, $tabImages, $product->price,  $product->shortDescription, $product->stock, $product->advantages, $product->technicalInfos, $product->productComposition]);

        if (!$res)
            echo "An error has occurred when processing";

    }

        
        
            //////////////////// Close the database \\\\\\\\\\\\\\\\\\\\

    echo "Done\n";
    $db->closeDB();
?>