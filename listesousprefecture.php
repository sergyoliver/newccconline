<?php
if (isset($_GET['cd'])){

    $codedel = $_GET['cd'];

    $rsdel = $bdd->prepare('select * from tb_departement where code_departement= :d ');
    $rsdel->execute(array('d' => $codedel  ));
    $rowdel = $rsdel->fetch();


}
$i=1;


?>
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des sous prefectures
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
                            <a href="?page=listelocalite">
                                Liste des délégations
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="?page=listedepartement&cd=<?php echo $rowdel['delegation_code']?>">
                                Liste des departements
                            </a>
                        </li>

                        <li class="active breadcrumb-item">liste des Sous prefectures du departement  de : <?php echo $rowdel['designation']?> </li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Listes des sous prefectures
                            <a  href="#ajoutsp"  data-toggle="modal"  role="button"  class="btn btn-primary float-xs-right">
                            <i class="fa fa-plus" style="margin-right: 3%;"></i> Creer une sous prefecture
                            </a>
                        </div>
                        <div class="card-block m-t-35" id="retour_table">

                            <table id="example2"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code </th>
                                    <th>Désignation</th>
                                    <th>Nbre village</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare('select * from tb_sousprefecture where departement_code= :d ');
                                $rsg->execute(array('d' => $codedel));
                                while($rowg = $rsg->fetch()) {
                                    $codes = $rowg['code_sous_prefecture'];
                                    $rsppp = $bdd->prepare('select * from tb_village where sous_prefecture_code= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                    $rsppp->execute(array('d' => $codes  ));
                                    $nb = $rsppp->rowCount();

                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['code_sous_prefecture']; ?></td>
                                    <td><?php echo $rowg['designation']; ?></td>
                                    <td><a href="?page=listevillage&cd=<?php echo $rowg['code_sous_prefecture']; ?>"><?php echo number_format($nb); ?></a></td>

                                    <td>
                                            <a  data-toggle="modal"  href="#modifsp<?php echo $rowg['id']; ?>" class="todoedit">
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
                                                                <input type="hidden" class="form-control"  name="delm" id="delm<?php echo $rowg['id']; ?>" value="<?php echo $codedel ?>">
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

                        </div>
                    </div>
                <div class="modal fade bs-example-modal-md" id="ajoutsp" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
                    <div class="modal-dialog modal-sm rounded">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title text-white">Ajouter une sous prefecture de  <?php echo $rowdel['designation']?></h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-lg-12 input_field_sections">
                                        <h5> Saisir Sous prefecture </h5>
                                        <div class="input-group">
                                            <input type="text" class="form-control"  name="sp" id="sp" value="">
                                            <input type="hidden" class="form-control"  name="dep" id="dep" value="<?php echo $rowdel['code_departement']?>">
                                            <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>

                                <div class="input-group d-flex">
                                    &nbsp;<a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="ajouterdep()">Ajouter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
<script type="text/javascript" >
    function ajouterdep() {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("sp", $('#sp').val());
        form_data2.append("dp", $('#dep').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/ajoutsp.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function modifdep(str2,str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var dep = '#depm'+str;
        var del = '#delm'+str;
        var form_data2 = new FormData();
        form_data2.append("dp", $(del).val());
        form_data2.append("sp", $(dep).val());
        form_data2.append("id", str2);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/modifsp.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
</script>
