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
                Formulaire de mise à jour de producteur
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
                    <a href="?page=listeproducteur">Liste des producteurs</a>
                </li>
                <li class="active breadcrumb-item">Modifier </li>
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
                        Modifier un nouveau producteur
                    </div>
                    <div class="card-block">
                        <?php
                        if (isset($_GET['id'])){
                            $idp = $_GET['id'];
                            $rspm = $bdd->prepare('select * from tb_producteur where id = :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            $rspm->execute(array('d' => $idp ));
                            $rowpm= $rspm->fetch();
                        }
                        if (isset($_POST['ok'])){


                            $rsv = $bdd->prepare('select * from tb_producteur where nom = :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            $rsv->execute(array('d' => $_POST['nom'] ));
                            $nb= $rsv->rowCount();
                            if ($nb==0){
                                // on recherche le max
                                $rsp = $bdd->prepare('select * from tb_producteur ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                $rsp->execute();
                                $nbrep1= $rsp->rowCount();
                                $nbrep = $nbrep1+1;
                                $codevi = "PROD". numauto($nbrep,3);


                                $rs2 = $bdd->prepare('INSERT INTO tb_producteur(code_producteur, nom, date_de_naissance,lieu_de_naissance,genre,
numero_piece,contact,email,active,adresse_postale,date_creation,id_creation,taille,pointure,type_piece,nationalite,cel) 
VALUES(:code_producteur, :nom, :date_de_naissance,:lieu_de_naissance,:genre,
:numero_piece,:contact,:email,:active,:adresse_postale,:date_creation,:id_creation,:taille,:pointure,:type_piece,:nationalite,:cel)');

                                /*
                                                                $rs2->execute(array('code_producteur' => $codevi,'nom' => $_POST['nom'],'date_de_naissance' => formatinv_date($_POST['daten']),'lieu_de_naissance' => $_POST['lieun']
                                                                ,'genre' => $_POST['genre']  ,'numero_piece' => $_POST['nump']
                                                                ,'contact' => $_POST['tel'],'email' => $_POST['email'],'active' => 0,'adresse_postale' => $_POST['adresse'],'date_creation' => gmdate('Y-m-d H:i:s'),'id_creation' => $_SESSION['id'],
                                                                    'taille' => $_POST['taille'],'pointure' => $_POST['pointure'],'type_piece' => $_POST['naturep'],'nationalite' => $_POST['nat'],'cel' => $_POST['tel2']));*/

         }

                            header('location:accueil.php?page=listeproducteur');
                        }




                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-12 input_field_sections">

                                    <div class="col-lg-7 push-lg-4">
                                        <h5>Genre</h5>
                                        <label for="radio3" class="custom-control custom-radio signin_radio3">
                                            <input id="radio3" name="genre" type="radio" class="custom-control-input" value="MASCULIN"  <?php if($rowpm['genre']=='MASCULIN'){ echo 'checked'; } ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Masculin </span>
                                        </label>
                                        <label for="radio4" class="custom-control custom-radio signin_radio4">
                                            <input id="radio4" name="genre" type="radio" class="custom-control-input" value="FEMININ" <?php if($rowpm['genre']=='FEMININ'){ echo 'checked'; } ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Féminin</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12 input_field_sections">
                                    <h5>Nom et prénoms </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nom" style="font-size: 15px; font-weight: bold; " required value="<?php if($rowpm['nom']){ echo $rowpm['nom']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Date de Naissance </h5>

                                    <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-calendar text-primary"></i>
                                            </span>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="jj-mm-aaaa" id="dp1" name="daten" value="<?php if($rowpm['date_de_naissance']){ echo format_date($rowpm['date_de_naissance']); } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Lieu de naissance </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lieun" value="<?php if($rowpm['lieu_de_naissance']){ echo $rowpm['lieu_de_naissance']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Nature de la pièce </h5>

                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="naturep" id="naturep" >
                                            <option selected disabled></option>
                                            <option value="CNI" <?php if($rowpm['type_piece']=='CNI'){ echo 'selected'; } ?> >CNI</option>
                                            <option value="Passpport" <?php if($rowpm['type_piece']=='Passpport'){ echo 'selected'; } ?> >Passpport</option>
                                            <option value="Attestation d'identité" <?php if($rowpm['type_piece']=="Attestation d'identité"){ echo 'selected'; } ?>  >Attestation d'identité</option>
                                            <option value="Autres" <?php if($rowpm['type_piece']=='Autres'){ echo 'selected'; } ?>  >Autres</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Numéro de la pièce </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nump" value="<?php if($rowpm['numero_piece']){ echo $rowpm['numero_piece']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Nationalité </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nat" value="<?php if($rowpm['nationalite']){ echo $rowpm['nationalite']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Contact</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tel" id="tel" value="<?php if($rowpm['contact']){ echo $rowpm['contact']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Contact Mobile </h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="mob" id="mob" value="<?php if($rowpm['cel']){ echo $rowpm['cel']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Email</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php if($rowpm['email']){ echo $rowpm['email']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-3 input_field_sections">
                                    <h5>Adresse postale</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="adresse" id="adresse" value="<?php if($rowpm['adresse_postale']){ echo $rowpm['adresse_postale']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Taille en mètre</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="taille" id="taille" value="<?php if($rowpm['taille']){ echo $rowpm['taille']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Pointure en Cm</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pointure" id="pointure" value="<?php if($rowpm['pointure']){ echo $rowpm['pointure']; } ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>



                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg- p4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                        Mettre à jour
                                    </button>

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


