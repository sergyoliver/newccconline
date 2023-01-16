<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des utilisateurs
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

                        <li class="active breadcrumb-item">liste des utilisateurs</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Listes des utilisateurs
                            <a href="?page=ajoutcompte"  role="button"  class="btn btn-primary float-xs-right">
                                <i class="fa fa-plus" style="margin-right: 3%;"></i> Creer un nouveau Compte
                            </a>
                        </div>
                        <div class="card-block m-t-35">

                            <table id="example1"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom et prenoms</th>
                                    <th>Matricule</th>
                                    <th>Delegation</th>
                                    <th>Est admin</th>
                                    <th>Est agent</th>
                                    <th>Est Dr</th>
                                    <th>Est Dg</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare("select *,ag.active as a,ag.id as i from tb_agent ag,tb_delegation dl WHERE ag.delegation_code=dl.code_delegation ORDER BY ag.id desc");
                                $rsg->execute();
                                while($rowg = $rsg->fetch()) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['nom']." ". $rowg['prenoms']; ?></td>
                                    <td><?php echo $rowg['matricule']; ?></td>
                                    <td><?php echo $rowg['designation']; ?></td>
                                    <td><?php
                                        if ($rowg['est_admin']==1){
                                            echo 'Oui';
                                        }else{
                                            echo 'Non';
                                        }
                                         ?></td>
                                    <td><?php
                                        if ($rowg['est_agent']==1){
                                            echo 'Oui';
                                        }else{
                                            echo 'Non';
                                        }
                                         ?></td>
                                    <td><?php
                                        if ($rowg['est_dr']==1){
                                            echo 'Oui';
                                        }else{
                                            echo 'Non';
                                        }
                                        ?></td>
                                    <td><?php
                                        if ($rowg['est_dg']==1){
                                            echo 'Oui';
                                        }else{
                                            echo 'Non';
                                        }
                                        ?></td>
                                    <td><?php if ( $rowg['a']==1){ ?>
                                            <span class="label text-success ">Actif</span>
                                        <?php }else{
                                      //  echo $rowg['active'];
                                        ?>
                                            <span class="label text-danger ">Non Actif</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                            <a href="?page=modifcompte&id=<?php echo $rowg['i']; ?>" class="todoedit">
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

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
