<?php    

    // load up your config file
    require_once("../../config.php");
    require_once("../../app/src/States.php");
    require_once("../../app/src/Hotels.php");
     
    require_once(LAYOUT_PATH . "/header.php");

    $stateObj = new States();

    // read the states from the database
    $states = $stateObj->getStates(); 

    // close connection
    $stateObj->closeConnection();
            
    // form submitted
    if($_POST){
        
        $hotel = new Hotels();

        // set hotel property values
        $hotel->name = $_POST['name'];
        $hotel->description = $_POST['desc'];
        $hotel->stars = "0." . $_POST['stars'];
        $hotel->id_city = $_POST['city'];
                
        // created correctly
        if($hotel->create()){
            echo "<div class='alert alert-success'> El hotel " . $hotel->name . " fue guardado exitosamente </div>";
        }

        // there was an error creating
        else{
            echo "<div class='alert alert-danger'> No se pudo guardar el hotel </div>";
        }
    }


?>


<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">
            Nuevo Hotel
        </h3> 
        
    </div>
    <div class="panel-body">        
        <!-- HTML form for creating an hotel -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" required>

            <div class="form-group">
                <label for="name">Hotel</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Hotel" required> 
            </div>
            <div class="form-group">
                <label for="desc">Descripción</label>
                <input type="text" class="form-control" id="desc" name="desc" placeholder="Descripción" required>
            </div>            
            <div class="form-group">
                <label for="desc">Estrellas</label>
                <input type="number" class="form-control" id="stars" name="stars" placeholder="Estrellas" required min="1" max="5">
            </div>
                     
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">               
                        <label for="desc">Estado</label>
                        <!-- put states in a select drop-down -->
                        <select class='form-control' name='state' id="state" required>
                            <option>Seleccionar estado...</option>                      
                                <?php foreach ($states as $row): ?>
                                    <option value="<?= $row['id_state'] ?>"><?= $row['state'] ?></option>
                                <?php endforeach ?>                    
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">               
                        <label for="desc">Ciudad</label>
                        <!-- put states in a select drop-down -->
                        <select class='form-control' name='city' id="city" required>             
                        </select>
                    </div>
                </div>
            </div>
                        
            <center>
                <button type="submit" class="btn btn-success">Crear</button>
            </center>

        </form>
    </div>
</div>

<script>

    $(function() {
        $(".li-nav").removeClass("active");
        $("#new").addClass("active");
    });
    
    // Variable to hold request
    var request;
    
    $(document).on("change", '#state', function(e) {
            var state = $(this).val();   
        
            //get cities by state
            $.ajax({
                url: "../resources/getCities.php",
                type: "post",
                data: {state: state},
                success: function (response) {
                    var $el = $("#city");
                    $el.empty(); // remove old options
                    $el.append("<option>Seleccionar ciudad...</option>");   
                    $el.append(response); //add cities
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        });
    
</script>

<?php
    require_once(LAYOUT_PATH . "/footer.php");
?>