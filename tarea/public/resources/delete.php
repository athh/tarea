<?php

    
    require_once("../../app/src/Hotels.php");

    // if id is not set, return to list   
    if(!isset($_POST['id'])){
        header("Location: ../views/list.php"); /* Redirect lo list */
        exit();
    }

    $hotel = new Hotels();

    if($hotel->delete($_POST['id'])){
        return true;
    }else{
        return false;
    }
        

    
?>