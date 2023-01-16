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
               Formulaire d'ajout de passage
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
                    <a href="?page=lpassage">Liste des passages</a>
                </li>
                <li class="active breadcrumb-item">Ajouter nouveau passage</li>
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
                       Ajouter un nouveau passage
                    </div>
                    <div class="card-block">
                        <?php
                        $erreur='';
                        if (isset($_POST['ok'])){


                         //  var_dump($codepar);
                            $nump = 'PASSAGE '.$_POST['nump'];


                            $rsp = $bdd->prepare("select * from tb_passage where type_pied = :t  and  type_periode = :p and  libelle = :l ");
                            $rsp->execute(array('t' => $_POST['culture'], 'p' => $_POST['periode'], 'l' => $nump ));
                            $rowp = $rsp->fetch();
                              $idpassage = $rowp['id'];

               // echo "select * from passage_periodes where campagne = '". $_POST['campagne']."' and type_pied = '". $_POST['culture']."' and  type_periode = '". $_POST['periode']."' and  date_debut = '". formatinv_date($_POST['datedebut'])."'  and  date_fin = '".  formatinv_date($_POST['datefin'])."' ";
                            $rsp1 = $bdd->prepare("select * from passage_periodes where campagne = :c and type_pied = :t and  type_periode = :p and  date_debut = :db  and  date_fin = :df ");
                            $rsp1->execute(array('c' => $_POST['campagne'],'t' => $_POST['culture'], 'p' => $_POST['periode'], 'db' => formatinv_date($_POST['datedebut']), 'df' =>formatinv_date($_POST['datefin'])  ));
                            $rowp1 = $rsp1->fetch();

                            if (empty($rowp1['libelle'])){
                                $rs2 = $bdd->prepare('INSERT INTO passage_periodes(passage_id, libelle, type_pied,
type_periode,date_debut,date_fin,date_creation,id_enregistrement,campagne,activev,supp,nump) 
VALUES(:passage_id, :libelle, :type_pied,:type_periode,:date_debut,
:date_fin,:date_creation,:id_enregistrement,:campagne,:activev,:supp,nump)');

                                /*  var_dump(array('passage_id' => $idpassage,'libelle' => $_POST['lib'], 'type_pied' => $_POST['culture'], 'type_periode' => $_POST['periode']
                                  , 'date_debut' => formatinv_date($_POST['datedebut']),'actif'=> formatinv_date($_POST['datefin']),'date_creation'=> gmdate("Y-m-d H:i:s"),'id_enregistrement'=> $_SESSION['id'],
                                      'campagne' => $_POST['campagne'],'activev'=> $_POST['active'],'supp'=>0));
                                  */

                                $rs2->execute(array('passage_id' => $idpassage,'libelle' => $_POST['lib'], 'type_pied' => $_POST['culture'], 'type_periode' => $_POST['periode'],
                                    'date_debut' => formatinv_date($_POST['datedebut']),'date_fin'=> formatinv_date($_POST['datefin']),'date_creation'=> gmdate("Y-m-d H:i:s"),
                                    'id_enregistrement'=> $_SESSION['id'], 'campagne' => $_POST['campagne'],'activev'=> $_POST['actif'],'supp'=>0,'nump'=>$_POST['nump']));
                                /* */

                                header('location:accueil.php?page=lpassage');
                            }else{
                                $erreur ='<h4 style="color: red"> CE PASSAGE EXISTE DEJA !!!!</h4>';
                            }

                        }



echo $erreur;
                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">
                            <div class="row">

                            <div class="col-lg-12 input_field_sections">

                                <div class="col-lg-4 push-lg-4">
                                    <h5>Type de culture</h5>
                                    <label for="radio34" class="custom-control custom-radio signin_radio34">
                                        <input id="radio34" name="culture" type="radio" class="custom-control-input" value="C"  checked>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Café </span>
                                    </label>
                                    <label for="radio44" class="custom-control custom-radio signin_radio44">
                                        <input id="radio44" name="culture" type="radio" class="custom-control-input" value="K">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Cacao</span>
                                    </label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h5>Désignation </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="" name="lib" id="lib">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Campagne </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="xxxx-yyyy" name="campagne" id="campagne">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Periode</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="periode" id="periode"  >
                                            <option selected disabled>-</option>
                                                <option value="INTERMEDIAIRE">INTERMEDIAIRE</option>
                                                <option value="PRINCIPALE">PRINCIPALE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Passage</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="nump" id="nump"  >
                                            <option selected disabled>-</option>

                                            <?php
                                           for($i=1; $i<7;$i++){
                                                ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 input_field_sections">
                                    <h5>Date debut</h5>
                                    <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-calendar text-primary"></i>
                                            </span>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="jj-mm-aaaa" id="dp1" name="datedebut">
                                    </div>
                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Date fin</h5>
                                    <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-calendar text-primary"></i>
                                            </span>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="jj-mm-aaaa" id="dp2" name="datefin">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 input_field_sections">

                                    <div class="col-lg-7 push-lg-4">
                                        <h5>Statut</h5>
                                        <label for="radio3" class="custom-control custom-radio signin_radio3">
                                            <input id="radio3" name="actif" type="radio" class="custom-control-input" value="1"  checked>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Activé </span>
                                        </label>
                                        <label for="radio4" class="custom-control custom-radio signin_radio4">
                                            <input id="radio4" name="actif" type="radio" class="custom-control-input" value="0">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Désactivé</span>
                                        </label>
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
                                      Creer Passage
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
