<?php // Connection à la base de données
//error_reporting(0);
require ('../connexion/connectpg.php');
require('../connexion/function.php');

if (isset($_POST['codedel']) ) {

    $i = 0;
    $dp = strtoupper($_POST['lib']);
    $del=$_POST['codedel'];
    $codes=$_POST['secret'];
    $id=$_POST['id'];
   // var_dump($_POST);



        $rs2 = $bdd->prepare('UPDATE tb_delegation set  designation = :designation, secret = :s, datemodif = :d, idmodif = :idm where code_delegation = :id');
        $rs2->execute(array('designation' => $dp,'s' => $codes,'d' => gmdate('Y-m-d H:i:s'),'idm' => $_POST['sess'], 'id' => $id));



    }
?>

<table id="example2"  class="table2excel display table table-stripped table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Code delegation</th>
        <th>Désignation</th>
        <th>Nbre departement</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $i=1;
    $rsg = $bdd->prepare(' select * from tb_delegation ORDER by designation asc ');
    $rsg->execute();
    while($rowg = $rsg->fetch()) {
        $codedel = $rowg['code_delegation'];
        $rsppp = $bdd->prepare('select * from tb_departement where delegation_code= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsppp->execute(array('d' => $codedel  ));
        $nb = $rsppp->rowCount();

        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rowg['code_delegation']; ?></td>
            <td><?php echo $rowg['designation']; ?></td>
            <td><a href="?page=listedepartement&cd=<?php echo $rowg['code_delegation']; ?>"><?php echo number_format($nb); ?></a></td>

            <td>
                <a   data-toggle="modal"  href="#modifdel<?php echo $rowg['id']; ?>" class="todoedit">
                    <span class="fa fa-pencil"></span>
                </a>
                <span class="dividor">|</span>
                <a href="#" class="tododelete redcolor">
                    <span class="fa fa-trash"></span>
                </a>

            </td>
        </tr>
        <div class="modal fade bs-example-modal-md" id="modifdel<?php echo $rowg['id']; ?>" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
            <div class="modal-dialog modal-sm rounded">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-white">Modifier  <?php echo $rowg['designation'] ?></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-12 input_field_sections">
                                <h5>Modifier délégation </h5>
                                <div class="input-group">
                                    <input type="text" class="form-control"  name="depm1" id="depm1<?php echo $rowg['id']; ?>" value="<?php echo $rowg['designation'] ?>">
                                    <input type="hidden" class="form-control"  name="delm1" id="delm1<?php echo $rowg['id']; ?>" value="<?php echo $codedel ?>">
                                    <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-12 input_field_sections">
                                <h5>Code de changement </h5>
                                <div class="input-group">
                                    <input type="text" class="form-control"  name="codet" id="codet<?php echo $rowg['id']; ?>" value="<?php echo $rowg['secret'] ?>">
                                    <span class="input-group-addon"> <i class="fa fa-pencil-square text-primary"></i>                                        </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>

                        <div class="input-group d-flex">
                            <button type="button" data-dismiss="modal" class="btn btn-primary pull-left">Annuler</button> &nbsp;
                            <a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="modifdel('<?php echo $codedel ?>',<?php echo $rowg['id']; ?>)">Oui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $i++; } ?>
    </tbody>
</table>
