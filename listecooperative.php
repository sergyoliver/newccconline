
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des fichiers shapefiles
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
<div class="col-lg-12 m-t-35">
    <div class="card">
        <div class="card-header card-primary">Importer fichiers shapefiles dans la base de données</div>

        <div class="card-block">

            <div class="row">
                <div class="col-lg-12 input_field_sections">
                    <h5>Choix des couches </h5>
                    <div class="input-group">
                        <?php
                        $rs3=$bdd->prepare("SELECT nom_coop FROM table_parcelle GROUP BY nom_coop");
                        $rs3->execute();
                        ?>
                        <select class="form-control chzn-select" name="couche" id="couche" required  tabindex="1" onchange="ajout()">
                            <option  disabled  selected value="-1">Selectionner</option>
                            <option     value="all">Aucun</option>
                            <?php while ($row3 = $rs3->fetch()) { ?>
                                <option value="<?php echo $row3['nom_coop']; ?>" ><?php echo $row3['nom_coop']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <hr />
            <div class="form-group row">
                <div class="col-lg-2 input_field_sections"></div>
                <div class="col-lg-5 push-lg-2">
                    <button class="btn btn-primary" type="submit" id="ok" name="ok" onclick="ajout()">
                        <i class="fa fa-user"></i>
                        Rechercher
                    </button>

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
    </div>


        </div>

    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript" >
    function ajout() {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("c", $('#couche').val());
        form_data2.append("nf", $('#nf').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rechcoo.php", true);
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

