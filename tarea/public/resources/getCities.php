<?php

    require_once("../../app/src/Cities.php");

        // get state from ajax function
        if(isset($_POST['state'])){
            $state = $_POST['state'];
            
            $citiesObj = new Cities();
            
            $cities = $citiesObj->getCitiesbyState($state);
            
            foreach($cities as $row) {
                echo "<option value='" . $row['id_city'] . "'>" . $row['city'] . "</option>";
            }
            
            $citiesObj->closeConnection();
        }
        


?>

