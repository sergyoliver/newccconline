<link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/scroller.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/colReorder.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="vendors/datatables/css/dataTables.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="css/pages/dataTables.bootstrap.css?d=<?php echo time() ?>" />
<!-- end of plugin styles -->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="css/pages/tables.css?d=<?php echo time() ?>" />
<header class="head">
    <div class="main-bar row">
        <div class="col-sm-5 col-lg-6 skin_txt">
            <h4 class="nav_top_align">
                <i class="fa fa-table"></i>
                Liste des Passages
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

                <li class="active breadcrumb-item">Liste des passages</li>
            </ol>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container forms">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                    <div class="card-header bg-white">
                        <i class="fa fa-table"></i> Listes des passages
                        <a href="?page=ajoutpassage"  role="button"  class="btn btn-primary float-xs-right" style="">
                            <i class="fa fa-plus" style="margin-right: 3%;"></i> Ajouter passage
                        </a>
                    </div>
                    <div class="card-block m-t-35">
                        <table id="example1" class="display table table-stripped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Désignation</th>
                                <th>Culture</th>
                                <th>Campagne</th>
                                <th>Période</th>
                                <th>Date debut</th>
                                <th>Date fin</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=1;
                            $rsg = $bdd->prepare('select *,passage_periodes.type_pied as c,passage_periodes.id as idp from passage_periodes,tb_passage WHERE passage_id =tb_passage.id and  passage_periodes.supp=0 ORDER by passage_periodes.id DESC ');
                            $rsg->execute();
                            while($rowg = $rsg->fetch()) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['libelle']; ?></td>
                                    <td><?php if ($rowg['c']=='K') echo 'Cacao'; else echo 'Café' ?></td>
                                    <td><?php echo $rowg['campagne']; ?></td>
                                    <td><?php echo $rowg['type_periode']; ?></td>
                                    <td><?php if (isset($rowg['date_debut'])){ echo format_date($rowg['date_debut']); }  ?></td>
                                    <td><?php if (isset($rowg['date_fin'])){ echo format_date($rowg['date_fin']); }  ?></td>
                                    <td><?php if (isset($rowg['activev']) and $rowg['activev']==1 ){ echo '<span style="color: green; font-weight: bold">Activé</span>'; }else{echo '<span style="color: red">Désactivé</span>'; }  ?></td>
                                    <td>
                                        <a href="?page=modifpassage&id=<?php echo $rowg['idp']; ?>" class="todoedit">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        <span class="dividor"> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;</span>
                                        <a href="#" class="tododelete redcolor">
                                            <span class="fa fa-trash"></span>
                                        </a>

                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>