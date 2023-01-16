<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des producteurs
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

                        <li class="active breadcrumb-item">liste des producteurs</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Listes des producteurs
                            <a href="?page=ajoutproducteur"  role="button"  class="btn btn-primary float-xs-right">
                                <i class="fa fa-plus" style="margin-right: 3%;"></i> Ajouter un producteur
                            </a>
                        </div>

                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12 input_field_sections">
                                <div class="input-group" id="retour_table">
                                    <table id="example2" class="table table-striped table-bordered table_res dataTable ">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code producteur</th>
                                            <th>Nom et prenoms</th>
                                            <th>Date et lieu de naissance</th>
                                            <th>Genre</th>
                                            <th>contact</th>
                                            <th>nationalite</th>
                                            <th>taille(m)</th>
                                            <th>pointure(cm)</th>
                                            <th>Actions</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $i=1;
                                        $rs3=$bdd->prepare("SELECT * FROM tb_producteur ORDER BY  nom asc");
                                        $rs3->execute();
                                        while ($row3 = $rs3->fetch()) { ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row3['code_producteur']; ?></td>
                                            <td><?php echo $row3['nom']; ?></td>
                                            <td><?php echo $row3['date_de_naissance'] .'/'.$row3['lieu_de_naissance']; ?></td>
                                            <td><?php echo $row3['genre']; ?></td>
                                            <td><?php echo $row3['contact']; ?></td>
                                            <td><?php echo $row3['nationalite']; ?></td>
                                            <td><?php echo $row3['taille']; ?></td>
                                            <td><?php echo $row3['pointure']; ?></td>
                                            <td>
                                                <a href="?page=modifprod&id=<?php echo $row3['id']; ?>"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
                                                &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
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
        </div>
    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
<script type="text/javascript" >
    function ajout() {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("p", $('#prod').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rechparcelle.php", true);
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