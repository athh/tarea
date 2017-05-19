<?php 

//Connectio class
require_once("../../app/src/Connection.php");

//States class
class States extends Connection{
    
    // object properties
    var $id_state;
    var $state;

    /*function __construct($id_state, $state)
    {
        $this->id_state = $id_state;
        $this->state = $state;
    }*/
    
    // Get all the states from db
    function getStates(){        
        return $this->query("SELECT * FROM STATES");
        
    }
}

?>