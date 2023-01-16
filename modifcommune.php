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
<!--End of plugin styles-->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="css/pages/form_elements.css"/>
<link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

<header class="head">
    <div class="main-bar row">
        <div class="col-sm-5 col-lg-6 skin_txt">
            <h4 class="nav_top_align">
                <i class="fa fa-pencil"></i>
               Formulaire de mise à jour
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
                    <a href="?page=listecompte">Liste des communes</a>
                </li>
                <li class="active breadcrumb-item">Modifier commune</li>
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
                        Modifier commune
                    </div>
                    <div class="card-block">
                        <?php
                        if(isset($_GET['id'])){


                            try{
                                $id = $_GET['id'];
                                $rsa = $bdd->prepare('select * from tab_commune where  idcom = :j2');
                                $rsa->execute(array("j2" => $id));
                                $rowa = $rsa->fetch();

                            } catch (Exception $e) {
                                echo 'Erreur : ' . $e->getMessage() . '<br />';
                                echo 'N� : ' . $e->getCode();
                            }
                        }
                        if (isset($_POST['ok'])){


                    $com =  $_POST['com'];
                    $dt = date("Y-m-d H:i:s");
                    // je verifie si la com n existe pas

                            $rs = $bdd->prepare('select * from tab_commune where  libellecom = :l');
                            $rs->execute(array("l" => $com));
                            $nb = $rs->rowCount();
                            if ($nb==0){
                                try {


                                    $rsql1 = $bdd->prepare('UPDATE  tab_commune SET  libellecom = :libellecom
                                                       WHERE idcom = :idcom ');
                                    $tab = $rsql1->execute(array('libellecom' => $com, 'idcom' => $id));


                                } catch (Exception $e) {

                                    echo 'Erreur : ' . $e->getMessage() . '<br />';

                                    echo 'N° : ' . $e->getCode();

                                }

                            }

                            header("location:?page=listecommune");
                        }

                        ?>
                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-lg-12 input_field_sections">
                                    <h5>Commune </h5>
                                    <div class="input-group">
                                        <input name="com" type="text" value="<?php if(isset($rowa['libellecom'])){ echo $rowa['libellecom'];}  ?>"  class="form-control" placeholder="Ajouter villes">
                                        <span class="input-group-addon"> <i class="fa fa-braille text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>





                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg-5 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-braille"></i>
                                       Modifier Commune
                                    </button>
                                    <button class="btn btn-warning" type="reset" id="clear">
                                        <i class="fa fa-refresh"></i>
                                        Annuler
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


