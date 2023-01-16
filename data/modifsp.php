<?php // Connection à la base de données
//error_reporting(0);
require ('../connexion/connectpg.php');
require('../connexion/function.php');

if (isset($_POST['dp']) ) {

    $i = 0;
    $dp = strtoupper($_POST['sp']);
    $sp=$_POST['dp'];
    $id=$_POST['id'];
//var_dump($_POST);



        $rs2 = $bdd->prepare("UPDATE tb_sousprefecture set  designation = :designation  where  code_sous_prefecture = :id ");
        $rs2->execute(array('designation' =>$dp, 'id' =>$id));



    }
?>

<table id="example2"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code </th>
                                    <th>Désignation</th>
                                    <th>Nbre sous préfecture</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare('select * from tb_sousprefecture where departement_code= :d  ORDER BY code_sous_prefecture  desc');
                                $rsg->execute(array('d' => $sp));
                                while($rowg = $rsg->fetch()) {
                                    $codesp = $rowg['code_sous_prefecture'];
                                    $rsppp = $bdd->prepare('select * from tb_village where sous_prefecture_code= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                    $rsppp->execute(array('d' => $codesp  ));
                                    $nb = $rsppp->rowCount();

                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rowg['code_sous_prefecture']; ?></td>
                                        <td><?php echo $rowg['designation']; ?></td>
                                        <td><a href="?page=listevillage&cd=<?php echo $rowg['code_sous_prefecture']; ?>"><?php echo number_format($nb); ?></a></td>

                                        <td>
                                            <a   data-toggle="modal"  href="#modifsp<?php echo $rowg['id']; ?>" class="todoedit">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <span class="dividor">|</span>
                                            <a href="#" class="tododelete redcolor">
                                                <span class="fa fa-trash"></span>
                                            </a>

                                        </td>
                                    </tr>
                                    <div class="modal fade bs-example-modal-md" id="modifsp<?php echo $rowg['id']; ?>" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
                                        <div class="modal-dialog modal-sm rounded">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title text-white">Modifier  <?php echo $rowg['designation'] ?></h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-lg-12 input_field_sections">
                                                            <h5>Modifier Sous prefecture </h5>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"  name="depm" id="depm<?php echo $rowg['id']; ?>" value="<?php echo $rowg['designation'] ?>">
                                                                <input type="hidden" class="form-control"  name="delm" id="delm<?php echo $rowg['id']; ?>" value="<?php echo $sp ?>">
                                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>

                                                    <div class="input-group d-flex">
                                                        <button type="button" data-dismiss="modal" class="btn btn-primary pull-left">Annuler</button> &nbsp;
                                                        <a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="modifdep('<?php echo $rowg['code_sous_prefecture'] ?>',<?php echo $rowg['id']; ?>)">Oui</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php $i++; } ?>
</tbody>
</table>
