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
               Formulaire de Mise à jour
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
                    <a href="?page=luser">Liste des comptes</a>
                </li>
                <li class="active breadcrumb-item">Modifier un compte</li>
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
                      Modifier compte
                    </div>
                    <div class="card-block">
                        <?php
                        if(isset($_GET['id'])){


                        try{
                            $id = $_GET['id'];
                            $rsa = $bdd->prepare('select * from tb_agent where  id = :j2');
                            $rsa->execute(array("j2" => $id));
                            $rowa = $rsa->fetch();

                            } catch (Exception $e) {
                                echo 'Erreur : ' . $e->getMessage() . '<br />';
                                echo 'N� : ' . $e->getCode();
                            }
                        }
                        if (isset($_POST['ok'])){



                            //echo $nom = $_POST['nom'];
                            /// renomme le img
//                            require('connexion/function.php');
//                            require ('connexion/connectpg.php');
                                try {
                                    //                            $rs3 = $bdd->prepare('INSERT INTO tab_histoconnexion(ipaddress,user_email , datecon, statconn) VALUES(:ipadress, :log, :datc, :statc)');
                                    //                            $rs3->execute(array('ipadress' => get_ip(), 'log' => $log ,'datc' => gmdate("Y-m-d H:i:s"), 'statc' => 1));

                                    $dat = date("Y-m-d H:i:s");
                                    $rsql1 = $bdd->prepare('UPDATE  tb_agent SET matricule = :matricule,  nom = :nom,  prenoms = :prenoms, contact = :contact, 
                            fonction = :fonction,date_modification = :date_modification,  est_admin = :est_admin, est_agent = :est_agent,  est_dg = :est_dg,  est_dr = :est_dr,   active = :active,id_modification = :id_modification
                            ,delegation_code = :delegation_code ,login = :login,email = :email
                               WHERE id = :id ');
                                  //  print_r($rsql1);
                                    $tab = $rsql1->execute(array('matricule' => $_POST['mat'],'nom' => $_POST['nom'],'prenoms' => $_POST['pnom'],'contact' => $_POST['tel']
                                    ,'fonction' => $_POST['fonction'] ,'date_modification' => gmdate('Y-m-d H:i:s') ,'est_admin' => $_POST['admin']
                                    ,'est_agent' => $_POST['ag'],'est_dg' => $_POST['dg'],'est_dr' => $_POST['dr'],'active' => $_POST['statut'],'id_modification' => $_SESSION['id'],'delegation_code' => $_POST['dep'],
                                        'login' => $_POST['pwd'],'email' => $_POST['email'],'id' => $id));


                                } catch (Exception $e) {

                                    echo 'Erreur : ' . $e->getMessage() . '<br />';

                                    echo 'N° : ' . $e->getCode();

                                }


                       header("location:?page=luser");
                        }

                        ?>
                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col-lg-8 input_field_sections">
                                    <h5>Délégation </h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep"  >
                                            <option >Délégation</option>
                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select * from tb_delegation dl  ORDER BY designation ASC ');
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_delegation'] ?>" <?php if (isset($rowa['delegation_code']) && $rowa['delegation_code']==$rowdep['code_delegation']){echo "selected";   }  ?>><?php echo $rowdep['designation'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Matricule </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="mat" style="font-size: 15px; font-weight: bold; background-color: rgba(255,118,22,0.13)" required value="<?php echo $rowa['matricule']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Nom </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nom" value="<?php echo $rowa['nom']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-8 input_field_sections">
                                    <h5>Prénoms </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pnom" value="<?php echo $rowa['prenoms']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-3 input_field_sections">
                                    <h5>Contact</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $rowa['contact']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Email</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $rowa['email']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-3 input_field_sections">
                                    <h5>Mot de passe</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pwd" id="pwd" value="<?php echo $rowa['login']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Fonction</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="fonction" id="fonction" value="<?php echo $rowa['fonction']?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-lg-8 input_field_sections">

                                    <div class="col-lg-6 ">
                                        <h5>Type de compte</h5>
                                        <label for="radio3" class="custom-control custom-checkbox signin_radio3">
                                            <input id="radio3" name="admin" type="checkbox" class="custom-control-input" value="1" <?php if($rowa['est_admin']==1) echo 'checked' ?>  >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Est Admin </span>
                                        </label>
                                        <label for="radio4" class="custom-control custom-checkbox signin_radio4">
                                            <input id="radio4" name="dg" type="checkbox" class="custom-control-input" value="1" <?php if($rowa['est_dg']==1) echo 'checked' ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Est DG</span>
                                        </label>
                                        <label for="radio5" class="custom-control custom-checkbox signin_radio4">
                                            <input id="radio5" name="dr" type="checkbox" class="custom-control-input" value="1" <?php if($rowa['est_dr']==1) echo 'checked' ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Est DR</span>
                                        </label>
                                        <label for="radio6" class="custom-control custom-checkbox signin_radio4">
                                            <input id="radio6" name="ag" type="checkbox" class="custom-control-input" value="1" <?php if($rowa['est_agent']==1) echo 'checked' ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Est Agent</span>
                                        </label>

                                    </div>
                                </div>
                                <div class="col-lg-4 input_field_sections">

                                    <div class="col-lg-8 ">
                                        <h5>Statut</h5>
                                        <label for="radio31" class="custom-control custom-radio signin_radio3">
                                            <input id="radio31" name="statut" type="radio" class="custom-control-input" value="1" <?php if($rowa['active']==1) echo 'checked' ?>  >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Activé </span>
                                        </label>
                                        <label for="radio41" class="custom-control custom-radio signin_radio4">
                                            <input id="radio41" name="statut" type="radio" class="custom-control-input" value="0" <?php if($rowa['active']==0) echo 'checked' ?>>
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
                                <div class="col-lg- p4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                        Creer Compte
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