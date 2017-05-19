<?php

//Class connection to database

class Connection {
    
    protected $pdo;
    
    //contruct to connect to database
    function __construct() {

        try {
            //connection
            $this->pdo = new PDO('mysql:host=localhost;dbname=tarea', 'root', '123qwe', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        }
        catch (PDOException $e) {
            //managing errors
            echo $e->getMessage();
        }
    }

    //close connection
    public function closeConnection() {

        $this->pdo = null;
    }
    
    //query with a string given
    public function query($query)
    {
        return $this->pdo->query($query);
    }
    
    
}

?>