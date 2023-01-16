<nav class="navbar navbar-static-top">
    <div class="container-fluid">
        <a class="navbar-brand text-xs-center" href="index.html">
            <h4 class="text-white"> CCC</h4>
        </a>
        <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
        </div>

        <!-- Toggle Button -->
        <div class="text-xs-right xs_menu">
            <button class="navbar-toggler hidden-xs-up" type="button" data-toggle="collapse" data-target="#nav-content">
                ☰
            </button>
        </div>
        <!-- Nav Content -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="topnav dropdown-menu-right float-xs-right">
            <div class="btn-group">

                <div class="user-settings no-bg">
                    <a class="btn btn-default no-bg micheal_btn" href="?page=milieu">
                        <p class="text-white" style="vertical-align: middle;margin-bottom: 0"> Accueil</p>
                    </a>


                </div>
            </div>
            <div class="btn-group">

                <div class="user-settings no-bg">
                    <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                        Comptage   <i class="fa fa-bars text-white"></i><span class="fa fa-sort-down white_bg"></span>
                    </button>
                    <div class="dropdown-menu admire_admin">


                        <a class="dropdown-item" href="?page=requete"><i class="fa fa-database"></i>
                            Requetes</a>

                        <a class="dropdown-item" href="?page=comptage_cacao"><i class="fa fa-cogs"></i>
                            Comptages Cacao</a>
                        <a class="dropdown-item" href="?page=comptage_cafe"><i class="fa fa-cogs"></i>
                            Comptages Café</a>
                    </div>
                </div>
            </div>
            <div class="btn-group">

                <div class="user-settings no-bg">
                    <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                        Config<span class="fa fa-sort-down white_bg"></span>
                    </button>
                    <div class="dropdown-menu admire_admin">

                        <a class="dropdown-item" href="?page=luser"><i class="fa fa-home"></i>
                            Compte Utilisateurs</a>
                        <a class="dropdown-item" href="?page=listelocalite"><i class="fa fa-database"></i>
                            Localités</a>

                        <a class="dropdown-item" href="?page=listeparcelle"><i class="fa fa-cogs"></i>
                            Parcelles
                        </a>
                        <a class="dropdown-item" href="?page=listeproducteur"><i class="fa fa-cogs"></i>
                            Producteurs
                        </a>
                    </div>
                </div>
            </div>



            <div class="btn-group">
                <div class="user-settings no-bg">
                    <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                        <strong><?php echo  $_SESSION['nom'] ?></strong>
                        <span class="fa fa-sort-down white_bg"></span>
                    </button>
                    <div class="dropdown-menu admire_admin">

                        <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>
                            Parametre compte</a>

                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>
                            Deconnexion</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse navbar-toggleable-sm col-xl-6 col-lg-6 hidden-md-down float-xl-right  top_menu" id="nav-content">
            <ul class="nav navbar-nav top_menubar">
                <li class="nav-item" style="padding: 4px">
                    <img src="icon/logodash.jpg" class="" style="height: 35px" alt="logo">
                </li>

            </ul>
        </div>
    </div>

    <!-- /.container-fluid -->
</nav>