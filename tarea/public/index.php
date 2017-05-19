<?php    
    // load up your config file
    require_once("../config.php");
     
    require_once(LAYOUT_PATH . "/header.php");

header("Location: views/list.php"); /* Redirect lo list */
        exit();
?>

<div id="container">
    <div id="content">
        <!-- content -->
    </div>
</div>

<?php
    require_once(LAYOUT_PATH . "/footer.php");
?>