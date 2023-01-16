<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
<!--End of plugin styles-->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/inputlimiter/css/jquery.inputlimiter.css"/>
<link type="text/css" rel="stylesheet" href="vendors/chosen/css/chosen.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jquery-tagsinput/css/jquery.tagsinput.css"/>
<link type="text/css" rel="stylesheet" href="vendors/daterangepicker/css/daterangepicker.css"/>
<link type="text/css" rel="stylesheet" href="vendors/datepicker/css/bootstrap-datepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/fileinput/css/fileinput.min.css"/>
<link type="text/css" rel="stylesheet" href="css/pages/form_elements.css"/>
<link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

<header class="head">
    <div class="main-bar row">
        <div class="col-sm-5 col-lg-6 skin_txt">
            <h4 class="nav_top_align">
                <i class="fa fa-pencil"></i>
               Formulaire d'ajout de compte
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
                    <a href="?page=listeparcelle">Liste des parcelles</a>
                </li>
                <li class="active breadcrumb-item">Ajouter nouvelle parcelle</li>
            </ol>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container forms">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-white">
                       Ajouter un nouveau compte
                    </div>
                    <div class="card-block">
                        <?php
                        if (isset($_POST['ok'])){
                           $codepar =   generer_codepar($_POST['actif'],$_POST['dep']);
                         //  var_dump($codepar);
                            $vvv = $_POST['vil'] ;
                            echo "select * from tb_village where code_village ='$vvv' ";
                            $rsv = $bdd->prepare('select * from tb_village where code_village = :d ');
                            $rsv->execute(array('d' => $_POST['vil'] ));
                            $rowv = $rsv->fetch();
                            echo $sp = $rowv['sous_prefecture_code'];


                            $rs2 = $bdd->prepare('INSERT INTO tb_parcelle(code_parcelle, delegation_code, code_sous_prefecture,village_code,type_plantation,
departement_code,nom_parcelle,longitude,latitude,date_creation,dateenr,id_enregistrement,code_prod,variete,superficie,production_annuelle,annnee_creation,
observation_variete,active,supp,mode_aquisition) 
VALUES( :code_parcelle, :delegation_code, :code_sous_prefecture,:village_code,:type_plantation,
:departement_code,:nom_parcelle,:longitude,:latitude,:date_creation,:dateenr,:id_enregistrement,:code_prod,:variete,:superficie,:production_annuelle,:annnee_creation,
:observation_variete,:active1,:supp,:mode_aquisition)');


$rs2->execute(array('code_parcelle' => $codepar[0],'delegation_code' => $codepar[1], 'code_sous_prefecture' => $sp, 'village_code' => $_POST['vil']
, 'type_plantation' => $_POST['actif'],'departement_code'=> $_POST['dep'],'nom_parcelle'=> $_POST['nomsite'],'longitude'=> $_POST['long']
,'latitude'=> $_POST['lat'],'date_creation'=> formatinv_date($_POST['Datedebut']),'dateenr'=> gmdate("Y-m-d H:i:s"),'id_enregistrement'=> $_SESSION['id'],'code_prod'=> $_POST['prod']
,'variete'=> $_POST['variete'],'superficie'=> $_POST['sup'],'production_annuelle'=> $_POST['prodan'],'annnee_creation'=> $_POST['an'],'observation_variete'=> $_POST['obs'],'active1'=>0,'supp'=>0,'mode_aquisition'=> $_POST['modea']));
/*
         var_dump(array('code_parcelle' => $codepar[0],'delegation_code' => $codepar[1], 'code_sous_prefecture' => $sp, 'village_code' => $_POST['vil']
         , 'type_plantation' => $_POST['actif'],'departement_code'=> $_POST['dep'],'nom_parcelle'=> $_POST['nomsite'],'longitude'=> $_POST['long']
         ,'latitude'=> $_POST['lat'],'etat_parcelle'=> 0,'date_creation'=> formatinv_date($_POST['Datedebut']),'dateenr'=> gmdate("Y-m-d H:i:s"),'id_enregistrement'=> $_SESSION['id'],'code_prod'=> $_POST['prod']
         ,'variete'=> $_POST['variete'],'superficie'=> $_POST['sup'],'production_annuelle'=> $_POST['prodan'],'annnee_creation'=> $_POST['an'],'observation_variete'=> $_POST['obs'],'active'=>0,'supp'=>0));
                            */
header('location:accueil.php?page=listeparcelle');
                        }




                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-lg-12 input_field_sections">

                                <div class="col-lg-7 push-lg-6">
                                    <h5>Type de plantation</h5>
                                    <label for="radio3" class="custom-control custom-radio signin_radio3">
                                        <input id="radio3" name="actif" type="radio" class="custom-control-input" value="CAFE"  checked>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Café </span>
                                    </label>
                                    <label for="radio4" class="custom-control custom-radio signin_radio4">
                                        <input id="radio4" name="actif" type="radio" class="custom-control-input" value="CACAO">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Cacao</span>
                                    </label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h5>Producteurs</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="prod" id="prod"  >
                                            <option selected disabled>Producteurs</option>
                                            <option value="0">Inconnu</option>
                                            <?php
                                            $p=1;
                                            $rsprod = $bdd->prepare('select * from tb_producteur  ORDER BY nom ASC ');
                                            $rsprod->execute();
                                            while($rowprod = $rsprod->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowprod['code_producteur'] ?>"><?php echo $rowprod['nom'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>
                                    <span style="text-align: center"><a href="">Ajouter nouveau producteur</a></span>

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Délégation / Departement</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep" onchange="check_parcelle(this.value)" >
                                            <option selected disabled>Departement</option>
                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select *,dp.designation as dpt from tb_departement dp,tb_delegation dl WHERE dl.code_delegation=dp.delegation_code ORDER BY dpt ASC ');
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_departement'] ?>"><?php echo $rowdep['designation'].' / '. $rowdep['dpt'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Sous Prefecture / Village</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="vil" id="vil" >
                                            <option selected disabled></option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Nom du site</h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nomsite">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Variétés</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="variete" id="variete"  >
                                            <option selected disabled>variete</option>
                                            <option value="Café arabica"> Café arabica</option>
                                            <option value="Café robusta"> Café robusta</option>
                                            <option value="Café nvelle variété"> Café nvelle variété</option>
                                            <option value="Cacao ancien"> Cacao ancien</option>
                                            <option value="Cacao Mercedes"> Cacao Mercedes</option>


                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Mode d'acquisition</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="modea" id="modea" >
                                            <option selected disabled></option>
                                            <option value="achat" >achat</option>
                                            <option value="héritage" >héritage</option>
                                            <option value="location" >location</option>
                                            <option value="partenariat" >partenariat</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Superficie ha</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="sup" id="sup">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Date de creation</h5>
                                    <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-calendar text-primary"></i>
                                            </span>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="jj-mm-aaaa" id="dp1" name="Datedebut">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Année de creation</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="an" id="an">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Production Annuelle</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="prodan" id="prodan">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Latitude</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="long" id="long">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div><div class="col-lg-3 input_field_sections">
                                    <h5>Longitude</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lat" id="lat">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h3>Observation</h3>
                                    <div class="form-group">
                                        <textarea  class="form-control"  name="obs" rows="4" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg-4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                      Creer Parcelle
                                    </button>

                                </div>
                            </div>
                    </div>
                </div>
                        </form>
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

<script type="text/javascript" src="js/pages/datetime_piker.js?d=<?php echo time() ?>"></script>

<script type="text/javascript">
    function check_parcelle(str) {
        //il fait la mise a jour du prix de base et l'observation
        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("code", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rechvillage.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                document.getElementById("vil").innerHTML = this.responseText;
                $("#vil").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }

</script>
