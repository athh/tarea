<?php

//Connectio class
require_once("../../app/src/Connection.php");

class Hotels extends Connection{
  
    // object properties
    public $id;
    public $name;
    public $description;
    public $stars;
    public $id_city;
    public $id_state;
    public $city;
    public $state;
  
    //get all the active hotels
    public function list($from_record_num, $records_per_page){
        
        //getting all active hotels
        return $this->query("SELECT h.*, c.city, s.state FROM hotels as h " .
                            "join cities as c on h.id_city = c.id_city " .
                            "join states as s on c.id_state = s.id_state " .
                            "where h.status = 'Activo' " .
                            "ORDER BY h.id_hotel ASC LIMIT " . $from_record_num . ", " . $records_per_page);
    }
    
    //paging 
    function countHotels(){        
        $query = "SELECT * FROM hotels where status = 'Activo'"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        return $num;
    }
    
    // create new
    function create(){
 
        //write query
        $stmt = $this->pdo->prepare("INSERT INTO `hotels` (`hotel`, `description`, `stars`, `id_city`, `status`) VALUES (:name, :description, :stars, :id_city, 'Activo');");
        //$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); //managing errors
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);                 //
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);   //binding params
        $stmt->bindParam(':stars', $this->stars, PDO::PARAM_STR);               //
        $stmt->bindParam(':id_city', $this->id_city, PDO::PARAM_INT);           //
        
        if($stmt->execute()){
            return true;
        }else{
            //Managing errors
            // $this->pdo->errorCode());
            return false;
        }
 
    }
    
    
    // get data from id hotel to update    
    public function getHotelData($id){
 
        $this->id = $id;
        
        //write query 
        $stmt = $this->pdo->prepare("SELECT h.*, c.id_city, c.city, s.id_state, s.state FROM hotels as h " .
                                    "join cities as c on h.id_city = c.id_city " .
                                    "join states as s on c.id_state = s.id_state " .
                                    "WHERE id_hotel =:id");
        
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //setting results
        $this->name = $row['hotel'];
        $this->description = $row['description'];
        $this->stars = $row['stars'];
        $this->id_city = $row['id_city'];
        $this->id_state = $row['id_state']; 
        $this->city = $row['city'];
        $this->state = $row['state'];     
                
        return $this;
    }
    
    function update($id){
 
        //write query
        $stmt = $this->pdo->prepare("UPDATE hotels SET hotel =:name, description =:description, stars =:stars, id_city =:id_city WHERE id_hotel =:id ;");
        //$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); //managing errors
        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);                 //
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);                 //
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);   //binding params
        $stmt->bindParam(':stars', $this->stars, PDO::PARAM_STR);               //
        $stmt->bindParam(':id_city', $this->id_city, PDO::PARAM_INT);           //
        
        if($stmt->execute()){
            return true;
        }else{
            //Managing errors
            // $this->pdo->errorCode());
            return false;
        }
 
    }
    
    function delete($id){
        //write query
        $stmt = $this->pdo->prepare("UPDATE hotels SET status = 'Inactivo' WHERE id_hotel =:id ;");
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); //managing errors
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);                 //binding params
        
        if($stmt->execute()){
            return true;
        }else{
            //Managing errors
            var_dump($this->pdo->errorCode());
            return false;
        }
    }
    
}
?>