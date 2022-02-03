<?php
/**
 * Manage database: Connection/disconnection and queries
 * @since 08.04.2021
 */


class Database {
    /*
        SQLSTATE[HY000] [1698] Access denied for user 'root'@'localhost'

        => "Turns out you can't use the root user in 5.7 anymore without becoming a sudoer. That means you can't just run mysql -u root anymore and have to do sudo mysql -u root instead."

        Therefore, I created a USER named user without password to access the db
    */
    private $pdo;
    private string $dbhost = "localhost";
    private string $dbuser = "user";           
    private string $dbpass = "";

    private string $db = "dbProducts";
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    function __construct (){

    }

    /**
     * Open the database
     * 
     */
    function openDB(){           

        try {
            $this->pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->db", $this->dbuser, $this->dbpass, $this->options);
            
            //Exception is not thrown => successfully connected to the db
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Connection to the database failed : " . $e->getMessage();
        }   
    }



    /**
     * Close the database
     */
    function closeDB(){
        $this->pdo = null;
    }


    /**
     * Get product row from database
     * 
     * @param id Id of the product (€ [|1; $this->nbProducts()|])
     * @return product Product's row as an array [name => , images => , price => , ...]
     */
    function getProductFromDB(int $id){


            //////////////////// Check if the id is valide ([|1; nbProducts|]) \\\\\\\\\\\\\\\\\\\\
        
        if ($id > $this->nbProducts() || $id <= 0)
            return;
        
        
        
            //////////////////// Id is valide, return the whole row \\\\\\\\\\\\\\\\\\\\

        $res = $this->pdo->prepare("SELECT * FROM Products WHERE id=?");
        $res->execute([$id]);
        return ($res->fetch());
    }


    /**
     * Set the stock value of a product 
     * 
     * @param nameElement Name of the product
     * @param value Stock value
     * @return res True if stock has been successfully modified, false otherwise
     */
    function setStock(int $id, int $value){
        
        
            //////////////////// Check if id references an actual product \\\\\\\\\\\\\\\\\\\\

        if ($id <= 0 || $id > $this->nbProducts()){
            echo "$id doesn't reference an actual product";
            return;
        }
        
        
        
            //////////////////// $nameElement is a product, set stock \\\\\\\\\\\\\\\\\\\\
        
        try {
            $stock = $this->getProductFromDB($id)['stock'];
            $res = $this->pdo->prepare("UPDATE Products SET stock = ? WHERE id=?");
            $res->execute([$stock - $value,$id]);
            return ($res);
        } catch (PDOException $e) {
            echo "Connection with database must be established before trying to set stock";
        }            
    }



    /**
     * Count the number of Products in the database
     * 
     * @return nb The number of Products in the database
     */
    function nbProducts(){
        try {
            $res = $this->pdo->query("SELECT * FROM Products")->rowCount();
            return ($res);
        } catch (PDOException $e) {
            echo "Connection with database must be established before trying use it";
        } 
    }
}

?>
