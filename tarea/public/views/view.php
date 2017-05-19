<?php    

    // load up your config file
    require_once("../../config.php");
    require_once("../../app/src/States.php");
    require_once("../../app/src/Hotels.php");
     
    require_once(LAYOUT_PATH . "/header.php");

    if(!isset($_GET['id'])){
        header("Location: list.php"); /* Redirect lo list */
        exit();
    }    

    $hotelObj = new Hotels();

    $hotel = $hotelObj->getHotelData($_GET['id']);

    $stateObj = new States();

    // read the states from the database
    $states = $stateObj->getStates(); 

    // close connection
    $stateObj->closeConnection();
            
?>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Hotel <b><?= $hotel->name; ?></b>
        </h3> 
        
    </div>
    <div class="panel-body">        
        <!-- show the hotel data -->
        
        <table width="100%">
            <tr>
                <td style="width: 20%;">
                    <h4 for="name">Hotel:</h4>
                </td>
                <td>
                    <h5><?= $hotel->name; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Descripción:</h4>
                </td>
                <td>
                    <h5><?= $hotel->description; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Estrellas:</h4>
                </td>
                <td>
                    <h5 style="color: blue; font-size: x-large;">
                        <?php
                        
                        $stars = str_replace("0.","",$hotel->stars); 
                        for($i = 0; $i < $stars; $i++ ) {
                            echo " ✰ ";
                         }
                        
                        ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Estado:</h4>
                </td>
                <td>
                    <h5><?= $hotel->state; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Ciudad:</h4>
                </td>
                <td>
                    <h5><?= $hotel->city; ?></h5>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>

    $(function() {
        $(".li-nav").removeClass("active");
        
    });
    
</script>

<?php
    require_once(LAYOUT_PATH . "/footer.php");
?>