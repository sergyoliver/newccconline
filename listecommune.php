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
                Liste des Dossiers
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

                <li class="active breadcrumb-item">Liste des dossiers</li>
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
                        <i class="fa fa-table"></i> Listes des dossiers
                    </div>
                    <div class="card-block m-t-35">
                        <table id="example1" class="display table table-stripped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Commune</th>
                                <th>Date enregistrement</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=1;
                            $rsg = $bdd->prepare('select * from tab_commune  ORDER by libellecom ASC ');
                            $rsg->execute();
                            while($rowg = $rsg->fetch()) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['libellecom']; ?></td>
                                    <td><?php if (isset($rowg['datenr'])){ echo format_date($rowg['datenr']); }  ?></td>
                                    <td>
                                        <a href="?page=modifcommune&id=<?php echo $rowg['idcom']; ?>" class="todoedit">
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

