<?php 
 
//Connectio class
require_once("../../app/src/Connection.php");

//Cities class
class Cities extends Connection{
    
    // object properties
    var $id_city;
    var $city;
    var $id_state;
    
    //get all cities by id_state
    public function getCitiesbyState($id_state){
        return $this->query("SELECT * FROM cities where id_state = " . $id_state);
    }
    
}

?>