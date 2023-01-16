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
                            <a href="?page=milieu">
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
                <form action="data/exportexcel.php" method="post" >
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
                                    <option value="1" >Dans les forêts classée</option>
                                    <option value="2" >A 2 Km des forêts classées</option>
                                    <option value="5" >A 5 Km des Forêts classées</option>
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
                            <a href="javascript:void(0) " class="btn btn-primary"  id="ok2" >
                                <i class="fa fa-user"></i>
                                Rechercher
                            </a>

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
                </form>
            </div>


        </div>

        <div class="col-lg-6 m-t-35" style="">
            <div id="map" style="height: 500px"></div>

        </div>


    </div>
</div>
<div id="popup" class="ol-popup" style="margin-left: -3000px">
    <a href="#" id="popup-closer" class="ol-popup-closer" ></a>
    <div id="popup-content"></div>
</div>
<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>


<script type="text/javascript" src="ol6/ol.js?d=<?php echo time() ?>"></script>
<script type="text/javascript" src="ol6/switcher/ol-layerswitcher.js?d=<?php echo time() ?>"></script>
<!--<script src="ol6/jquery-3.3.1.min.js"></script>-->
<script type="text/javascript" src="ajoutlayer.js?d=<?php echo time() ?>"></script>
