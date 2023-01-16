<link rel="stylesheet" type="text/css" href="css/pages/widgets.css">
<link rel="stylesheet" href="ol6/ol.css?d=<?php echo time() ?>" />
<link rel="stylesheet" href="ol6/switcher/ol-layerswitcher.css?d=<?php echo time() ?>" />
<link rel="stylesheet" href="ol6/switcher/layerswitcher.css?d=<?php echo time() ?>" />
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                       DASHBORD
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-xs-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="accueil.php?page=milieu">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </header>
        <div class="col-lg-4 m-t-35">
            <div class="card">
                <div class="card-header card-primary" style="color: white">Repartition </div>

                <div class="card-block" style="background: transparent url(icon/main_bg.jpg) repeat 0 0;">
<?php
// nbre de departement
$rsd = $bdd->prepare('select * from tb_departement ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$rsd->execute();
$nbd = $rsd->rowCount();

?>
                    <div class="row" >
                        <div class="col-lg-12 input_field_sections" >
                            <div class="col-sm-6 col-xs-12 col-lg-6">
                                <div class="widget_icon_bgclr icon_align bg-white" >
                                    <div class="bg_icon bg_icon_success float-xs-left">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </div>
                                    <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                        <h3 id="widget_count1" ><?php echo number_format($nbd); ?></h3>
                                        <p style="font-size: 15px" >Departement</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // nbre de departement
                            $rsp = $bdd->prepare('select * from tb_parcelle WHERE supp =0 or supp is null', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            $rsp->execute();
                            $nbp = $rsp->rowCount();

                            ?>
                            <div class="col-sm-6 col-xs-12 col-lg-6">
                                <div class="widget_icon_bgclr icon_align bg-white">
                                    <div class="bg_icon bg_icon_success float-xs-left">
                                        <i class="fa fa-ellipsis-v " aria-hidden="true"></i>
                                    </div>
                                    <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                        <h3 id="widget_count1"><?php echo number_format($nbp); ?></h3>
                                        <p style="font-size: 15px">Nb parcelles</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <?php
                        // nbre de departement
                        $rssup = $bdd->prepare('select sum(CAST(superficie as FLOAT)) as sup from tb_parcelle WHERE supp =0 or supp is null');
                        $rssup->execute();
                        $rowsup = $rssup->fetch();

                        ?>
                        <div class="col-lg-12 input_field_sections">
                            <div class="col-sm-6 col-xs-12 col-lg-12 m-b-15">
                                <div class="widget_icon_bgclr icon_align bg-white" style="color: #696056">
                                    <div class="bg_icon bg_icon_success float-xs-left">
                                        <i class="fa fa-cube" aria-hidden="true"></i>
                                    </div>
                                    <div class="text-xs-right" style="color: #696056;  font-weight: bold;">
                                        <h3 id="widget_count1" ><?php echo number_format(round($rowsup['sup'],2)); ?></h3>
                                        <p style="font-size: 15px">Superficie Total en ha</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // nbre de departement
                            $rsprod = $bdd->prepare('select * from tb_producteur ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            $rsprod->execute();
                            $nbprod = $rsprod->rowCount();

                            ?>
                            <div class="col-sm-6 col-xs-12 col-lg-12">
                                <div class="widget_icon_bgclr icon_align bg-white" style="color: #696056">
                                    <div class="bg_icon bg_icon_primary float-xs-left">
                                        <i class="fa fa-users " aria-hidden="true"></i>
                                    </div>
                                    <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                        <h3 id="widget_count1" ><?php  echo number_format($nbprod); ?></h3>
                                        <p style="font-size: 15px">Nb Producteurs</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <br>


                </div>


            </div>


        </div>

        <div class="col-lg-8 m-t-35">
            <div class="card">

                <div style="align-content: center"><img src="icon/legende.jpg" style="text-align: center" alt=""></div>
                <div id="map" style="height: 500px"></div>
                <br>

            </div>



        </div>




    </div>
</div>
<div id="popup" class="ol-popup">
    <a href="#" id="popup-closer" class="ol-popup-closer" ></a>
    <div id="popup-content"></div>
</div>
<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="ol6/ol.js?d=<?php echo time() ?>"></script>
<script type="text/javascript" src="ol6/switcher/ol-layerswitcher.js?d=<?php echo time() ?>"></script>
<script type="text/javascript" src="ajoutparcelle2.js?d=<?php echo time() ?>"></script>
