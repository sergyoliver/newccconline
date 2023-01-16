<!DOCTYPE html>
<html lang="en" style=" height: 100%;
  padding: 0;
  margin: 0;
  font-family: sans-serif;
  font-size: small;">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<?php // Connection à la base de données
include 'connexion/connectpg.php';
include 'connexion/function.php';
?>
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
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <a class="navbar-brand text-xs-center" href="index.html">
                <h4 class="text-white"> CMOI</h4>
            </a>
            <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
            </div>

            <!-- Toggle Button -->
            <div class="text-xs-right xs_menu">
                <button class="navbar-toggler hidden-xs-up" type="button" data-toggle="collapse" data-target="#nav-content">
                    ☰
                </button>
            </div>
            <!-- Nav Content -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="topnav dropdown-menu-right float-xs-right">
                <div class="btn-group">

                </div>


                <div class="btn-group">

                    <div class="user-settings no-bg">
                        <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                            <i class="fa fa-bars text-white"></i><span class="fa fa-sort-down white_bg"></span>
                        </button>
                        <div class="dropdown-menu admire_admin">

                            <a class="dropdown-item" href="#"><i class="fa fa-home"></i>
                               Accueil</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-database"></i>
                               Requetes</a>

                            <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>
                                Gestions Shapefile</a>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <div class="user-settings no-bg">
                        <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                             <strong>Kassi</strong>
                            <span class="fa fa-sort-down white_bg"></span>
                        </button>
                        <div class="dropdown-menu admire_admin">

                            <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>
                                Parametre compte</a>

                            <a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i>
                               Deconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-toggleable-sm col-xl-6 col-lg-6 hidden-md-down float-xl-right  top_menu" id="nav-content">
                <ul class="nav navbar-nav top_menubar">
                    <li class="nav-item" style="padding: 4px">
                        <img src="icon/img_tranparence.png" class="" style="height: 35px" alt="logo">
                    </li>

                </ul>
            </div>
        </div>

        <!-- /.container-fluid --> </nav>
    <!-- /.navbar -->
    <!-- /.head --> </div>
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                       Gestion des requetes
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-xs-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="active breadcrumb-item">Requetes sur les coopératives</li>
                    </ol>
                </div>
            </div>
        </header>
    <div class="col-lg-6 m-t-35">
        <div class="card">
            <div class="card-header card-primary">Requetes sur la map</div>

            <div class="card-block">

                <div class="row">
                    <div class="col-lg-12 input_field_sections">
                        <h5>Choix des couches </h5>
                        <div class="input-group">
                            <?php
                            $rs3=$bdd->prepare("SELECT nom_coop FROM table_parcelle GROUP BY nom_coop");
                            $rs3->execute();
                            ?>
                            <select class="form-control chzn-select" name="couche" id="couche" required  tabindex="1">
                                <option  disabled  selected value="-1">Selectionner</option>
                                <option     value="all">Tous</option>
                                <?php while ($row3 = $rs3->fetch()) { ?>
                                    <option value="<?php echo $row3['nom_coop']; ?>" ><?php echo $row3['nom_coop']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 input_field_sections">
                        <h5>Choix kilometrage</h5>
                        <div class="input-group">
                            <select class="form-control chzn-select" name="km" id="km" >
                                <option selected disabled>Choisir la période</option>
                                <option value="0" >Aucun</option>
                                <option value="2" >2 Km</option>
                                <option value="5" >5 Km</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 input_field_sections" style="display: none">
                        <h5>Choix genre </h5>
                        <div class="input-group">
                            <select class="form-control chzn-select" name="scene" >
                                <option selected disabled>Choisir </option>
                                <option value="0" >Tous</option>
                                <option value="M" >Homme</option>
                                <option value="F">Femme</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 input_field_sections" style="display: none">
                        <h5>Saisir un informations </h5>
                        <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-subscript text-primary"></i></span>
                            <input autocomplete="off" type="text" class="form-control"  id="compc" name="compc"  >
                        </div>
                    </div>
                </div>
                <br>
                <hr />
                <div class="form-group row">
                    <div class="col-lg-2 input_field_sections"></div>
                    <div class="col-lg-5 push-lg-2">
                        <button class="btn btn-primary"  id="ok" name="ok">
                            <i class="fa fa-user"></i>
                            Rechercher
                        </button>

                    </div>
                </div>

            </div>

            <div class="card-block">
                <div class="row">
                    <div class="col-lg-12 input_field_sections">
                        <div class="input-group" id="retour_table">
                            <table id="example2" class="table table-striped table-bordered table_res dataTable ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom et Prenoms</th>
                                    <th>Genre</th>
                                    <th>Contact</th>
                                    <th>Superficie</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-lg-6 m-t-35" style="">
        <div id="map" style="height: 500px"></div>

    </div>

    <div id="popup" class="ol-popup">
        <a href="#" id="popup-closer" class="ol-popup-closer" ></a>
        <div id="popup-content"></div>
    </div>
    </div>
</div>







</body>
</html>