
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
                            <a href="index.html">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="active breadcrumb-item">Requetes sur les coopératives</li>
                    </ol>
                </div>
            </div>
        </header>
<div class="col-lg-8 m-t-35">
    <div class="card">
        <div class="card-header card-primary">Importer fichiers shapefiles dans la base de données</div>

        <div class="card-block">

            <div class="row">



                    <div class="col-lg-6 input_field_sections" style="display: ">
                    <h5>Données provenant de la cooperative   </h5>
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-subscript text-primary"></i></span>
                        <input autocomplete="off" type="text" class="form-control"  placeholder="nom de la coopérative" id="nc" name="compc"  >
                    </div>
                    </div>
                <div class="col-lg-6 input_field_sections" style="display: ">
                    <h5>Saisir nom du fichier shp    </h5>
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-subscript text-primary"></i></span>
                        <input autocomplete="off" type="text" class="form-control"  placeholder="Exemple: copago.shp" id="nf" name="compc"  >
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
<!-- global scripts-->
<script type="text/javascript" src="vendors/jquery.uniform/js/jquery.uniform.js"></script>
<script type="text/javascript" src="vendors/inputlimiter/js/jquery.inputlimiter.js"></script>
<script type="text/javascript" src="vendors/chosen/js/chosen.jquery.js"></script>
<script type="text/javascript" src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="vendors/jquery-tagsinput/js/jquery.tagsinput.js"></script>
<script type="text/javascript" src="vendors/validval/js/jquery.validVal.min.js"></script>
<script type="text/javascript" src="vendors/moment/js/moment.min.js"></script>
<script type="text/javascript" src="vendors/daterangepicker/js/daterangepicker.js"></script>
<script type="text/javascript" src="vendors/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="vendors/autosize/js/jquery.autosize.min.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.extensions.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/theme.js"></script>


<!--end of plugin scripts-->
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/pages/form_elements.js"></script>

<script type="text/javascript" src="ol6/ol.js?d=<?php echo time() ?>"></script>
<script type="text/javascript" src="ol6/switcher/ol-layerswitcher.js?d=<?php echo time() ?>"></script>
<!--<script src="ol6/jquery-3.3.1.min.js"></script>-->
<script type="text/javascript" src="ajoutlayer.js?d=<?php echo time() ?>"></script>

<script type="text/javascript" >
    function ajout() {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("nc", $('#nc').val());
        form_data2.append("nf", $('#nf').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/ajshp.php", true);
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

