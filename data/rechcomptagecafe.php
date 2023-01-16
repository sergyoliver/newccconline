<?php // Connection à la base de données
//error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['camp']) && isset($_POST['passage']) && isset($_POST['par']) ) {




    $sqlcp = $bdd->prepare("SELECT *  from tb_comptage_cafe WHERE idpassage= :p and parcelle_code= :par and an_campagne = :an  ");
    # Try query or error

    $sqlcp->execute(array("p" => $_POST['passage'], "par" => $_POST['par'], "an" => $_POST['camp']));


    $m = 1;
    ?>

    <div class="row">
    <div class="col-lg-6">
        <div class="card card-inverse m-t-35">
            <div class="card-header card-primary">Etat sur le comptage  : <?php
                $sql_par = $bdd->prepare("SELECT *  from tb_parcelle WHERE code_parcelle= :p  ");
                $sql_par->execute(array( "p" => $_POST['par']));
                $row_par = $sql_par->fetch();


                echo $row_par['code_parcelle'].' - '.$row_par['nom_parcelle']; ?></div>
            <div class="card-block">
                <table>
                    <tr><td><span style="color: #a22a4d; font-weight: bold; margin-right: 60px">Departement </span></td>
                        <td><?php  $sql_dep = $bdd->prepare("SELECT *  from tb_departement WHERE code_departement= :p  ");
                            $sql_dep->execute(array( "p" => $_POST['dep']));
                            $row_dep = $sql_dep->fetch();
                            echo $row_dep['designation']
                            ?></td>
                    </tr>
                    <tr><td><span style="color: #a22a4d; font-weight: bold; margin-right: 60px">Sous-Prefecture</span></td>
                        <td><?php

                            $sql_v = $bdd->prepare("SELECT *  from tb_village WHERE code_village= :p  ");
                            $sql_v->execute(array( "p" => $row_par['village_code']));
                            $row_v = $sql_v->fetch();
                            $sp =  $row_v['sous_prefecture_code'];

                         // echo  "SELECT *  from tb_sous_prefecture WHERE code_sous_prefecture='$sp'  ";
                            $sql_sp = $bdd->prepare("SELECT *  from tb_sousprefecture WHERE code_sous_prefecture= :p  ");
                            $sql_sp->execute(array( "p" => $row_v['sous_prefecture_code']));
                            $row_sp = $sql_sp->fetch();

                            echo $row_sp['designation'];


                            ?></td>
                    </tr>
                    <tr><td><span style="color: #a22a4d; font-weight: bold; margin-right: 60px">Village</span></td>
                        <td><?php  echo $row_v['designation']; ?></td>
                    </tr>

                    <tr><td style="color: #a22a4d;font-weight: bold">Campagne </td>
                        <td><?php echo $_POST['camp'] ?></td>
                    </tr>
                    <tr><td style="color: #a22a4d;font-weight: bold">Passage </td>
                        <td><?php  $sql_pass = $bdd->prepare("SELECT *  from tb_passage WHERE id= :p  ");
                            $sql_pass->execute(array( "p" => $_POST['passage']));
                            $row_pass = $sql_pass->fetch();
                            echo $row_pass['libelle']
                            ?></td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12 input_field_sections">
    <div class="input-group" >
    <table id="example2" class="table table-striped table-bordered table_res dataTable ">
        <thead>
        <tr>
            <th>#</th>
            <th>ARBRE</th>
            <th>COULEUR</th>
            <th>GRAPPE</th>
            <th>FRUIT</th>
            <th>FE</th>
            <th>FLO </th>
            <th>NOUE </th>
            <th>OBSERVATIONS </th>
            <th>Actions</th>

        </tr>
        </thead>

        <tbody>
        <?php
        while ($row = $sqlcp->fetch()) {
            $code_pied = $row['pied_code'];
            $sqlp = $bdd->prepare("SELECT *  from tb_pied WHERE code_pied= :c  ");
            $sqlp->execute(array("c" => $code_pied));
            $rowp = $sqlp->fetch();

            ?>
            <tr>
                <td><?php echo $m  ?></td>
                <td><?php echo $rowp['numero_pied']  ?></td>
                <td><?php echo $rowp['couleur']  ?></td>
                <td><?php echo $row['grappe']  ?></td>
                <td><?php echo $row['fruit']  ?></td>
                <td><?php echo $row['Fe']  ?></td>
                <td><?php echo $row['Flo']  ?></td>
                <td><?php echo $row['Noue']  ?></td>
                <td><?php if (isset($row['observation'])) echo $row['observation']  ?></td>
                <td> <a  href="#modif<?php echo $row['id']  ?>"  data-toggle="modal"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
                    &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
                </td>
            </tr>


            <div class="modal fade bs-example-modal-lg" id="modif<?php echo $row['id']  ?>" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
                <div class="modal-dialog modal-lg rounded">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title text-white">Mise à jour du comptage du pied:  <?php echo $rowp['numero_pied']  ?> <?php echo $rowp['couleur']  ?></h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-lg-3 input_field_sections">
                                    <h5> Grappe </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="g<?php echo $row['id']  ?>" id="g<?php echo $row['id']  ?>" value="<?php echo $row['grappe']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5> Fruit </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="f<?php echo $row['id']  ?>" id="f<?php echo $row['id']  ?>" value="<?php echo $row['fruit']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5> Fe </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="fe<?php echo $row['id']  ?>" id="fe<?php echo $row['id']  ?>" value="<?php echo $row['Fe']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5> Flo </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="flo<?php echo $row['id']  ?>" id="flo<?php echo $row['id']  ?>" value="<?php echo $row['Flo']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-lg-3 input_field_sections">
                                    <h5> Nouaison </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="noue<?php echo $row['id']  ?>" id="noue<?php echo $row['id']  ?>" value="<?php echo $row['Noue']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5> Pesé </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="pesef<?php echo $row['id']  ?>" id="pesef<?php echo $row['id']  ?>" value="<?php echo $row['peseF']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                    <div class="col-lg-3 input_field_sections">
                                    <h5> Production_oct_mars </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="prodom<?php echo $row['id']  ?>" id="prodom<?php echo $row['id']  ?>" value="<?php echo $row['production_oct_mars']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5> Production_avril_sept </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="prodom<?php echo $row['id']  ?>" id="prodas<?php echo $row['id']  ?>" value="<?php echo $row['production_avril_sept']  ?>">
                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h5>Observation </h5>
                                    <div class="input-group">
                                        <textarea  class="form-control"  name="obs<?php echo $row['id']  ?>" id="obs<?php echo $row['id']  ?>" ><?php echo $row['raison_supp']  ?></textarea>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>

                            <div class="input-group d-flex">
                                &nbsp;
                                <a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="ajouterdep()">Valider la mise à jour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $m++;  }
        ?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
    <?php
}
?>