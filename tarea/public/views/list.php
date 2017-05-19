<?php    
    // load up your config file
    require_once("../../config.php");
    require_once("../../app/src/Hotels.php");
     
    require_once(LAYOUT_PATH . "/header.php");

    $hotelObj = new Hotels();

    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // set number of records per page
    $records_per_page = 5;

    // calculate for the query LIMIT clause
    $from_record_num = ($records_per_page * $page) - $records_per_page;

    // read the states from the database
    $hotels = $hotelObj->list($from_record_num, $records_per_page); 

?>

<div id="container">
    <div id="content">
        
        <div style="height: 500px;">
            <table class="table table-striped">
                <th>Hotel</th>
                <th>Descripción</th>
                <th>Estrellas</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>

                <tbody>
                    <?php foreach($hotels as $row): ?>
                    <tr>
                        <td>
                            <?= $row['hotel'] ?>
                        </td>
                        <td>
                            <?= $row['description'] ?>
                        </td>
                        <td style="color: blue; font-size: x-large;">
                        <?php
                        
                        $stars = str_replace("0.","",$row['stars']); 
                        for($i = 0; $i < $stars; $i++ ) {
                            echo " ✰ ";
                         }
                        
                        ?>
                        </td>
                        <td>
                            <?= $row['city'] ?>
                        </td>
                        <td>
                            <?= $row['state'] ?>
                        </td>
                        <td>
                            <button type="button" class="view btn btn-default" aria-label="Left Align" id="<?= $row['id_hotel'] ?>">
                                <span class="glyphicon glyphicon-search" aria-hidden="true" style="color: blue;"></span>
                            </button> 
                        </td>
                        <td>
                            <button type="button" class="edit btn btn-default" aria-label="Left Align" id="<?= $row['id_hotel'] ?>">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: orange;"></span>
                            </button>                        
                        </td>
                        <td>
                            <button type="button" class="delete btn btn-default" aria-label="Left Align" id="<?= $row['id_hotel'] ?>">
                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color: red;"></span>
                            </button> 
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        
        </div>
            
        <div id="paging">
            <center>
                <!-- paging -->
                <?php
                    // the page where this paging is used
                    $page_url = "list.php?";

                    // count all hotels to calculate total pages
                    $hotelCount = $hotelObj->countHotels();

                    // paging buttons here
                    require_once(LAYOUT_PATH . "/paging.php");                        

                    // close connection
                    $hotelObj->closeConnection();
                ?>
            </center>
        </div>
    </div>
</div>

<script>

    $(function() {
        $(".li-nav").removeClass("active");
        $("#list").addClass("active");
    });
    
    $(document).on("click", '.edit', function(e) {
        id = this.id;
        location.href = "edit.php?id=" + id;    
    });
    
    $(document).on("click", '.view', function(e) {
        id = this.id;
        location.href = "view.php?id=" + id;
    });
    
    
    
    $(document).on("click", '.delete', function(e) {
        var id = this.id;
         
        bootbox.confirm({
        message: "<h4>¿Estas seguro que desea eliminar el hotel?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Si',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
    
            if(result==true){
                $.ajax({
                url: "../resources/delete.php",
                type: "post",
                data: {id: id},
                success: function (success) {
                    location.reload();
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
            }
        }
    });
 
    return false;
    });
    
</script>

<?php
    require_once(LAYOUT_PATH . "/footer.php");
?>