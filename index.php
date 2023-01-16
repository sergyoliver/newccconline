<?php session_start();
ob_start();
if(isset($_SESSION['email']))
{
    header('location:accueil.php?page=milieu');
}else{
    ?>
    <html>
    <head>
        <title>Login | Dashbord CCC </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="icon/icon.png?d=<?php echo time() ?>"/>
        <!--Global styles -->
        <link type="text/css" rel="stylesheet" href="css/components.css?d=<?php echo time() ?>"/>
        <link type="text/css" rel="stylesheet" href="css/custom.css?d=<?php echo time() ?>"/>
        <!--End of Global styles -->
        <!--Plugin styles-->
        <link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
        <link type="text/css" rel="stylesheet" href="vendors/wow/css/animate.css"/>
        <!--End of Plugin styles-->
        <link type="text/css" rel="stylesheet" href="css/pages/login.css?d=<?php echo time() ?>"/>
    </head>
    <body style="  background-image: url(icon/fond.jpg?d=<?php echo time() ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
        <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
            <img src="icon/logoaccueil.jpg" style=" width: 40px;" alt="loading...">
        </div>
    </div>
    <div class="container wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
        <div class="row">
            <div class="col-lg-8 push-lg-2 col-md-10 push-md-1 col-sm-10 push-sm-1 login_top_bottom">
                <div class="row">

                    <div class="col-lg-8 push-lg-2 col-md-10 push-md-1 col-sm-12">
                        <?php
                        if(isset($_POST['ok'])){

                            require ('connexion/connectpg.php');
                            require('connexion/function.php');

                            // cette page gere la verification pr la connexion :)
                            require('auth.php');




                        }else{
                            // echo "rien";
                            //echo  $_SERVER['REQUEST_METHOD'];

                        }

                        ?>
                        <div class="login_logo login_border_radius1" style="text-align: center">
                            <img src="icon/logoaccueil.jpg?v=<?php echo time()?>"  style="align-content: center; margin-top: 3px;width: 85%">

                            <p style="margin-bottom:3px;text-align: center; color: #fffefa; font-size: 17px; font-weight: bold"> BIENVENUE SUR  <span style="font-size: 20px"> VOTRE ESPACE</span> </p>
                        </div>
                        <div class="bg-white login_content login_border_radius">
                            <form action="" id="login_validator" method="post" class="login_validator">
                                <div class="form-group">
                                    <label for="email" class="form-control-label"> Login</label>
                                    <div class="input-group">
                                    <span class="input-group-addon input_email"><i
                                                class="fa fa-envelope text-primary"></i></span>
                                        <input type="text" class="form-control  form-control-md" id="email" name="login" placeholder="E-mail">
                                    </div>
                                </div>
                                <!--</h3>-->
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Mot de passe</label>
                                    <div class="input-group">
                                    <span class="input-group-addon addon_password"><i
                                                class="fa fa-lock text-primary"></i></span>
                                        <input type="password" class="form-control form-control-md" id="password"   name="pwd" placeholder="***********">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="submit" value="Se connecter" class="btn btn-primary btn-block login_button" style="background-color: #474540" name="ok">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <small style="display: none"></small>
                                    </div>
                                    <div class="col-xs-6 text-xs-right forgot_pwd">
                                        <a href="mdpoublie.php" class="custom-control-description "></a>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row" style="text-align: center; font-size: small; color: #ffffff;"> <div class="form-group col-lg-12">Gestion des activités de comptage   des Fruits du caféier et du cacaoyer  CCC @2022 - Tous droits réservés  </div></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- global js -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/tether.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- end of global js-->
    <!--Plugin js-->
    <script type="text/javascript" src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="vendors/wow/js/wow.min.js"></script>
    <!--End of plugin js-->
    <script type="text/javascript" src="js/pages/login.js?d=<?php echo time() ?>"></script>
    </body>

    </html>
    <?php
    //include 'logout.php';
}
ob_end_flush() ;
?>