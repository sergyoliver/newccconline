<!-- global styles-->

<link type="text/css" rel="stylesheet" href="../vendors/select2/css/select2.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="../vendors/datatables/css/scroller.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="../vendors/datatables/css/colReorder.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="../vendors/datatables/css/dataTables.bootstrap.min.css?d=<?php echo time() ?>" />
<link type="text/css" rel="stylesheet" href="../css/pages/dataTables.bootstrap.css?d=<?php echo time() ?>" />
<!-- end of plugin styles -->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="../css/pages/tables.css?d=<?php echo time() ?>" />

<header class="head">
    <div class="main-bar row">
        <div class="col-sm-5 col-lg-6 skin_txt">
            <h4 class="nav_top_align">
                <i class="fa fa-table"></i>
              Liste des comptes
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
                <li class="breadcrumb-item">
                    <a href="?page=ajoutcompte">Nouveau compte</a>
                </li>
                <li class="active breadcrumb-item">Liste des comptes</li>
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
                            <i class="fa fa-table"></i> Listes des utilisateurs
                        </div>
                        <div class="card-block m-t-35">

                            <table id="example1"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fonction</th>
                                    <th>Nom</th>
                                    <th>Prenoms</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Type de compte</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare('select * from agent,table_gpe  WHERE agent.gpe=table_gpe.idgpe ORDER by idqag DESC ');
                                $rsg->execute();
                                while($rowg = $rsg->fetch()) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['numag']; ?></td>
                                    <td><?php echo $rowg['nomag']; ?></td>
                                    <td><?php echo $rowg['prenom']; ?></td>
                                    <td><?php echo $rowg['emailag']; ?></td>
                                    <td><?php echo $rowg['telag']; ?></td>
                                    <td><?php echo $rowg['descn']; ?></td>

                                    <td><?php if ( $rowg['user_status']=='1'){ ?>
                                            <span class="label text-success ">Actif</span>
                                        <?php }else{ ?>
                                            <span class="label text-danger ">Non Actif</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                            <a href="?page=modifcompte&id=<?php echo $rowg['idqag']; ?>" class="todoedit">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <span class="dividor">|</span>
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

<script type="text/javascript" src="../js/components.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
