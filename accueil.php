<?php session_start();
error_reporting(0);
ob_start();

if(isset($_SESSION))
{

include 'connexion/connectpg.php';
include 'connexion/function.php';

?>
<!DOCTYPE html>
<html lang="en" style=" height: 100%;
  padding: 0;
  margin: 0;
  font-family: sans-serif;
  font-size: small;">
<head>
    <meta charset="UTF-8">
    <title>CCC - Projet de comptage des fruits de Café et de cacao</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="icon/icon.png?d=<?php echo time() ?>"/>
<!-- global styles-->
<link type="text/css" rel="stylesheet" href="css/components.css?d=<?php echo time() ?>"/>
<link type="text/css" rel="stylesheet" href="css/custom.css?d=<?php echo time() ?>"/>
<!--end of global styles-->
<link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css?d=<?php echo time() ?>" />
<!--end of global styles-->
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/scroller.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/colReorder.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/dataTables.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="css/pages/dataTables.bootstrap.css?d=<?php echo time() ?>" />
<!-- end of plugin styles -->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="css/pages/tables.css?d=<?php echo time() ?>" />

<!--plugin styles-->
<link type="text/css" rel="stylesheet" href="vendors/inputlimiter/css/jquery.inputlimiter.css"/>
<link type="text/css" rel="stylesheet" href="vendors/chosen/css/chosen.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jquery-tagsinput/css/jquery.tagsinput.css"/>
<link type="text/css" rel="stylesheet" href="vendors/daterangepicker/css/daterangepicker.css"/>
<link type="text/css" rel="stylesheet" href="vendors/datepicker/css/bootstrap-datepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/fileinput/css/fileinput.min.css"/>

<!--End of plugin styles-->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="css/pages/form_elements.css"/>
<link rel="stylesheet" href="ol6/ol.css?d=<?php echo time() ?>" />
<link rel="stylesheet" href="ol6/switcher/ol-layerswitcher.css?d=<?php echo time() ?>" />
<link rel="stylesheet" href="ol6/switcher/layerswitcher.css?d=<?php echo time() ?>" />

<body style=" height: 100%;
  padding: 0;
  margin: 0;
  font-family: sans-serif;
  font-size: small;">
<div id="top" class="">
    <!-- .navbar -->
    <?php include 'menu.php'; ?>
    <!-- /.navbar -->
    <!-- /.head -->
</div>
<?php
if (isset($_SESSION["id"])) {
    if (isset($_GET["page"]) && $_GET["page"] != '') {
        $page = htmlspecialchars_decode($_GET["page"]);

        $fichier = $page . '.php';
        if (file_exists($fichier)) {
            include($fichier);
        } else {
            header("location:accueil.php?page=milieu");
        }
    } else {
        header("location:accueil.php?page=milieu");
    } /**/
}else{
    header("location:index.php");
}
?>



<!-- global scripts-->
<script type="text/javascript" src="vendors/jquery.uniform/js/jquery.uniform.js"></script>
<script type="text/javascript" src="vendors/inputlimiter/js/jquery.inputlimiter.js"></script>
<script type="text/javascript" src="vendors/chosen/js/chosen.jquery.js"></script>
<script type="text/javascript" src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="vendors/jquery-tagsinput/js/jquery.tagsinput.js"></script>
<script type="text/javascript" src="vendors/validval/js/jquery.validVal.min.js"></script>
<script type="text/javascript" src="vendors/moment/js/moment.min.js"></script>
<script type="text/javascript" src="vendors/daterangepicker/js/daterangepicker.js"></script>
<script type="text/javascript" src="vendors/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="vendors/autosize/js/jquery.autosize.min.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.extensions.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/theme.js"></script>

<!--plugin scripts-->
<script type="text/javascript" src="vendors/select2/js/select2.js"></script>
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/pluginjs/dataTables.tableTools.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.responsive.min.js"></script>
<!--<script type="text/javascript" src="vendors/datatables/js/dataTables.rowReorder.min.js"></script>-->
<script type="text/javascript" src="vendors/datatables/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/buttons.print.min.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.scroller.min.js"></script>
<!-- end of plugin scripts -->
<!--Page level scripts-->
<script type="text/javascript" src="js/pages/simple_datatables.js"></script>
<!--end of plugin scripts-->
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/pages/form_elements.js"></script>

<!--<script src="ol6/jquery-3.3.1.min.js"></script>-->



</body>
</html>
    <?php

}else {
    header('location:index.php');
}

ob_end_flush() ;
?>