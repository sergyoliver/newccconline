
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<link rel="stylesheet" href="assets/js/bootstrap.min.css">
<link rel="stylesheet" href="assets/jscarte/leaflet.css" />

<style>

    #mapid {
        width: 90%;
        height:400px;
    }
.label{
    color: #000;
    font-weight: bold;
}
    </style>
<?php
if (isset($_SESSION['nom']) or isset($_COOKIE['tn'])){
if (isset($_GET['id'])){
    $id =$_GET['id'];
    require('connexion/function.php');
    require ('connexion/connectpg.php');
    // ON RECHERCHE LE DERNIER ENREGISTREMENT DU CONNECTE
    $rsd = $bdd->prepare('select MAX(idp) as idp from parcelles, tb_user WHERE tb_user.iduser=parcelles.idu AND  tb_user.emailuser = :idu');
    $rsd->execute(array("idu"=>$_COOKIE['tm']));
    $rowd = $rsd->fetch();
     $idder = $rowd['idp'];

    $rsdr = $bdd->prepare('select * from parcelles WHERE idp = :iduu');
    $rsdr->execute(array("iduu"=>$idder));
    $rowdr = $rsdr->fetch();
    $g = $rowdr['geom'];
    $proj = $rowdr['sysproj'];
   // echo "je jsuis ici".$rowdr['idp'];
   // echo $_SESSION['mail'];
    // on  affiche les bornes

// trouvons le centoide


    $sqlc = 'SELECT ST_X(ST_centroid(ST_Transform((geom),4326))) AS x,ST_Y(ST_centroid(ST_Transform((geom),4326))) AS y, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from parcelles WHERE idp = :p';
    $rsc=$bdd->prepare($sqlc);
    $rsc->execute(array("p"=>$idder));
    $rowc =$rsc->fetch();


    /// requete affichage polygone
    $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from parcelles WHERE idp = :p';
    $rs=$bdd->prepare($sql);
    $rs->execute(array("p"=>$idder));
    switch ($proj) {
        case "wgs": {
            /// requete affichage mos
            $sqlmos = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from mos';
            $rsmos = $bdd->prepare($sqlmos);
            $rsmos->execute();

/// requete affichage vrd
            $sqlvrd = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from vrd';
            $rsvrd = $bdd->prepare($sqlvrd);
            $rsvrd->execute();
/// requete affichage AUTRES
            $sqlautre = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from autre';
            $rsautre = $bdd->prepare($sqlautre);
            $rsautre->execute();
            break;
        }

        case "clac": {
            /// requete affichage mos
            $sqlmos = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from mos1';
            $rsmos = $bdd->prepare($sqlmos);
            $rsmos->execute();

/// requete affichage vrd
            $sqlvrd = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from vrd1';
            $rsvrd = $bdd->prepare($sqlvrd);
            $rsvrd->execute();
/// requete affichage AUTRES
            $sqlautre = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from autre1';
            $rsautre = $bdd->prepare($sqlautre);
            $rsautre->execute();
            break;
        }
    }
} ?>
<section class="pt-120 pb-90 primary-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- section title -->
                <div class="section-title text-center">
                    <span class="schoolbell">Avis de Servitude</span>

                </div><!-- /.End of section title -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <!-- single blog inner -->
                <div class="single-blog-inner" >
                    <!-- blog image -->

                    <!--End of  blog image -->

                    <!-- post content -->
                    <div class="post-content" >
                        <div class="post-details container body-container">



                            <div class="side-container" >
                                <div  class="col-md-12" style="display:none " id="test">
                                    <div class="col-xs-4 col-lg-2">
                                        <img src="assets/img/logoa.png" style="" width="40" height="31"/>
                                    </div>


                                </div>
                                <div  class="col-md-12"  >
                                    <div class="col-xs-4 col-lg-2">
                                        <img src="assets/img/logoa.png" style="" />
                                    </div>
                                    <div class="col-xs-8 col-lg-8">
                                        <h2 style="margin-top: 66px; font-family: 'calibri' ; margin-left: 46px; font-weight: bold ">FICHE DE RENSEIGNEMENT</h2>
                                        <p style="text-align: center; font-size: 14px; color: red; font-weight: bold; display: none">Avis de servitude </p>

                                    </div>


                                </div>
                                <div  class="col-md-12" >
                                    <div id="mapid"></div>
                                </div>

                                <br /><br /><br /><br />
                                <div id="" class="col-md-12" >
                                    <table class="table table-responsive-md table-bordered" id="bypassme" style="width: 90%" >
                                        <thead>
                                        <tr style="background-color: #3F3F3F; color: white">

                                            <th scope="col">Servitudes Observées : </th>
                                            <th scope="col">Conclusion</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr style="color: blue">

                                            <td >
                                                <?php
                                                /// trouver intersection
                                                $n=0;
                                                $m1=0;
                                                $nbpa=$nbvrd=$nbreretour=0;
                                                $servitude =array();
                                                $tab =array();
    switch ($proj) {
        case "wgs": {
            try {
                $rspmos = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) as detail, tb_typologie.idresultat as typ, mos.t  from mos,tb_typologie WHERE 
                                                  tb_typologie.type=mos.t AND  ST_Intersects(:d,geom)');
                $rspmos->execute(array(":d" => $g));
                $nbreretour = $rspmos->rowCount();

            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowp = $rspmos->fetch()) {
                if ($rowp['detail'] != "" or empty($rowp['detail'])) {
                    $tab[$n] = $rowp['typ'];
                    $tabt[$n] = $rowp['t'];
                    if ($rowp['t'] == 1 or $rowp['t'] == 2 or $rowp['t'] == 3 or $rowp['t'] == 16) {
                        $m1 = 1;
                    } else {
                        echo "- " . ucfirst(strtolower($rowp['detail'])) . "<br />";
                        $servitude[$n] = ucfirst(strtolower($rowp['detail']));
                    }
                    $n++;
                }

            }
            try {
                $rspvrd = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) AS detail,vrd.t, tb_typologie.idresultat as typ  from vrd,tb_typologie WHERE 
                                                  tb_typologie.type=vrd.t AND  ST_Intersects(:d,geom)');
                // nombre trouvé

                $rspvrd->execute(array(":d" => $g));
                $nbvrd = $rspvrd->rowCount();
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowpvrd = $rspvrd->fetch()) {
                if ($rowpvrd['detail'] != "") {
                    $tab[$n] = $rowpvrd['typ'];
                    $tabt[$n] = $rowpvrd['t'];
                    echo "- " . ucfirst(strtolower($rowpvrd['detail'])) . "<br />";
                    $servitude[$n] = ucfirst(strtolower($rowpvrd['detail']));
                    $n++;
                }
            }

            try {
                $rspa = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) AS detail,autre.t, tb_typologie.idresultat as typ  from autre,tb_typologie WHERE 
                                                  tb_typologie.type=autre.t AND  ST_Intersects(:d,geom)');
                $rspa->execute(array(":d" => $g));
                // nombre trouvé
                $nbpa = $rspa->rowCount();
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowpa = $rspa->fetch()) {
                if ($rowpa['detail'] != "" ) {
                    $tab[$n] = $rowpa['typ'];
                    $tabt[$n] = $rowpa['t'];
                    echo "- " . ucfirst(strtolower($rowpa['detail'])) . "<br />";
                    $servitude[$n] = ucfirst(strtolower($rowpa['detail']));
                    $n++;
                }
            }

        break;}
        case "clac": {
            $m1=0;
            try {
                $rspmos = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) as detail, tb_typologie.idresultat as typ, mos1.t  from mos1,tb_typologie WHERE 
                                                  tb_typologie.type=mos1.t AND  ST_Intersects(:d,geom)');
                $rspmos->execute(array(":d" => $g));
                $nbreretour = $rspmos->rowCount();

            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowp = $rspmos->fetch()) {
                if ($rowp['detail'] != "" ) {
                    $tab[$n] = $rowp['typ'];
                      $tabt[$n] = $rowp['t'];
                    if ($rowp['t'] == 1 or $rowp['t'] == 2 or $rowp['t'] == 3 or $rowp['t'] == 16) {
                        $m1 = 1;
                       // echo 'oui';
                    } else {
                        echo "- " . ucfirst(strtolower($rowp['detail'])) . "<br />";
                        $servitude[$n] = ucfirst(strtolower($rowp['detail']));
                    }
                    $n++;
                }

            }
            try {
                $rspvrd = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) AS detail,vrd1.t, tb_typologie.idresultat as typ  from vrd1,tb_typologie WHERE 
                                                  tb_typologie.type=vrd1.t AND  ST_Intersects(:d,geom)');
                // nombre trouvé

                $rspvrd->execute(array(":d" => $g));
                $nbvrd = $rspvrd->rowCount();
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowpvrd = $rspvrd->fetch()) {
                if ($rowpvrd['detail'] != "") {
                    $tab[$n] = $rowpvrd['typ'];
                    $tabt[$n] = $rowpvrd['t'];
                   echo "- " . ucfirst(strtolower($rowpvrd['detail'])) . "<br />";
                    $servitude[$n] = ucfirst(strtolower($rowpvrd['detail']));
                    $n++;
                }
            }

            try {
                $rspa = $bdd->prepare('SELECT  DISTINCT (tb_typologie.lib) AS detail,autre1.t, tb_typologie.idresultat as typ  from autre1,tb_typologie WHERE 
                                                  tb_typologie.type=autre1.t AND  ST_Intersects(:d,geom)');
                $rspa->execute(array(":d" => $g));
                // nombre trouvé
                $nbpa = $rspa->rowCount();
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N0 : ' . $e->getCode();
            }
            while ($rowpa = $rspa->fetch()) {
                if ($rowpa['detail'] != "") {
                    $tab[$n] = $rowpa['typ'];
                    $tabt[$n] = $rowpa['t'];
                    echo "- " . ucfirst(strtolower($rowpa['detail'])) . "<br />";
                    $servitude[$n] = ucfirst(strtolower($rowpa['detail']));
                    $n++;
                }
             }
           break; }
        }
                                                $tc=0;
                                                $tc= $count2 = count($servitude);
                                                $result = $nbpa +  $nbvrd + $nbreretour;
                                                if ( $count2==0 and $m1==1){
                                                    echo "Aucune Servitude";
                                                }
                                                if ($result==0){
                                                    echo "Hors Périmètre Urbain";
                                                }
                                                ?>
                                            </td>
                                            <td style="font-weight: bold;color: #ff1a1a ">
                                                <?php

                                              ///var_dump(array_unique( $servitude));
                                                   $count = count(array_unique($tab));
                                                //echo $count;
                                                switch ($count) {
                                                    case 1:{
                                                        if (in_array("1", array_unique($tab))) {
                                                            echo "Votre parcelle est frappée de servitudes";
                                                        }

                                                        if (in_array("2", array_unique($tab))) {
                                                            echo "Votre Parcelle n' est pas frappée de servitudes";
                                                        }
                                                        break;
                                                    }
                                                    case 2:{

                                                        echo "Votre Parcelle est partiellement frappée de servitude et necessite un redimensionnement en excluant les zones de servitudes.<br />";
                                                        echo '<span style=" font-size: small; color: #00AA00"> Veuillez Nous contacter  pour redimensionner votre parcelle: +225 22 43 51 88 / 04 29 24 47 ou envoyez un email à info@alertefoncier.ci</span> ';
                                                        break;
                                                    }
                                                    default: {echo "Votre Parcelle est  frappée de servitudes"; break;}
                                                }

                                                ?>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>

                                </div>


                                <p class="col-md-12 " style="width: 90%; font-size: 14px; line-height: 1.4; text-align: justify;  ">
                                    NB : Les résultats obtenus à partir de  l’application @AlerteServitude constituent de simples documents d’informations, de conseils et d’assistance. Les informations reçues ne peuvent en aucun cas être considérées comme un document administratif quelconque, ni un certificat d’urbanisme ou un avis de servitude délivré par l’administration. Elles n’ont aucun caractère opposable.
                                    Les résultats peuvent être consultés et/ou téléchargés.
                                </p>

                            </div>
                            <div class="col-md-12 " style="width: 90%; font-size: 14px; line-height: 1.4; text-align: justify;  ">
                            <p class="col-md-12 " style="text-align: right; "><a class="btn btn-default" href="#" id="download" role="button">Télécharger »</a></p>
                            </div>
                                <div class="col-md-12 " style="width: 90%; font-size: 14px; line-height: 1.4; text-align: justify;  ">

                                   <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Menu
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="?page=ajout&id=1">Avis de servitude</a>
                                            <a class="dropdown-item" href="#">Normes de construction</a>
                                            <a class="dropdown-item" href="#">Plan de situation</a>
                                        </div>
                                    </div>
                            </div>

                            <script>L_PREFER_CANVAS = true</script>
                            <script src="assets/js/img/leaflet.js"></script>
<!--                            <script src="testleaflet/js2/leaflet.js?v=--><?php //echo time(); ?><!--"></script>-->
                            <script src="assets/js/img/leaflet-image.js?v=<?php echo time(); ?>"></script>
<!--                            <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>-->
                            <script src="assets/js/jquery-1.12.3.min.js"></script>
                            <script src="assets/js/jspdft.min.js"></script>
                            <script src="assets/js/jspdf.plugin.autotable.js"></script>

                            <script>
                                var map = L.map('mapid', {
                                    renderer: L.canvas()
                                }).setView([<?php echo $rowc['y'] ?>, <?php echo $rowc['x'] ?>], 14);
                                map.createPane('labels');
                                map.getPane('labels').style.zIndex = 650;
                                map.getPane('labels').style.pointerEvents = 'none';

                                //    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                //        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                                //        maxZoom: 18
                                //    }).addTo(map);

                                var states = [
                                    <?php while($row = $rs->fetch()) { ?>
                                    {
                                        "type": "Feature",
                                        "geometry":<?php echo  $row['geojson']; ?>
                                    },
                                    <?php } ?>
                                ];
                                var states2 = [
                                    <?php while($rowmos = $rsmos->fetch()) { ?>
                                    {
                                        "type": "Feature",
                                        "properties": {"id2": "<?php echo  $rowmos['t']; ?>"},
                                        "geometry":<?php echo  $rowmos['geojson']; ?>
                                    },
                                    <?php } ?>
                                ];
                                var states3 = [
                                    <?php while($rowvrd = $rsvrd->fetch()) { ?>
                                    {
                                        "type": "Feature",
                                        "properties": {"id3": "<?php echo  $rowvrd['t']; ?>"},
                                        "geometry":<?php echo  $rowvrd['geojson']; ?>
                                    },
                                    <?php } ?>
                                ];
                                var states4 = [
                                    <?php while($rowautre = $rsautre->fetch()) { ?>
                                    {
                                        "type": "Feature",
                                        "properties": {"id4": "<?php echo  $rowautre['t']; ?>", "name": "<?php echo  $rowautre['name']; ?>"},
                                        "geometry":<?php echo  $rowautre['geojson']; ?>
                                    },
                                    <?php } ?>
                                ];
                                //

                                L.geoJSON(states2, {
                                    style: function(feature) {
                                        switch (feature.properties.id2) {
                                            case '0': return{
                                                color: "#a8a8a8",
                                                fillColor: "#a8a8a8",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '1': return{
                                                fillColor: "#ffd37f",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 1

                                            };
                                            case '2': return{

                                                fillColor:"#ffd37f",
                                                color: "#ffd37f",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '3': return{
                                                fillColor:"#ffaa00",
                                                color: "#ffaa00",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '4': return{
                                                fillColor: "#c07242",
                                                color: "#c07242",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0

                                            };
                                            case '5': return{
                                                fillColor: "#9900cc",
                                                color: "#9900cc",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '6': return{
                                                fillColor: "#ffbee8",
                                                fillOpacity: 1,
                                                color: "#ffbee8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '7': return{
                                                fillColor: "#00a69d",
                                                fillOpacity: 1,
                                                color: "#00a69d",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '8': return{
                                                fillColor: "#004da8",
                                                fillOpacity: 1,
                                                color: "#004da8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '9': return{
                                                fillColor: "#9dff96",
                                                fillOpacity: 1,
                                                color: "#9dff96",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '10': return{
                                                fillColor: "#9da15c",
                                                fillOpacity: 1,
                                                color: "#9da15c",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '11': return{
                                                fillColor: "#dedede",
                                                fillOpacity: 1,
                                                color: "#dedede",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '12': return{
                                                fillColor: "#d8f5c9",
                                                fillOpacity: 1,
                                                color: "#d8f5c9",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '13': return{
                                                fillColor: "#ff0000",
                                                fillOpacity: 1,
                                                color: "#ff0000",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '16': return{
                                                fillColor: "#f987f6",
                                                fillOpacity: 1,
                                                color: "#f987f6",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '40': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '41': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '42': return{
                                                fillColor: "#ffffff",
                                                fillOpacity: 1,
                                                color: "#ffffff",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '44': return{
                                                fillColor: "#dbd9d7",
                                                fillOpacity: 1,
                                                color: "#dbd9d7",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '79': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '80': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '900': return{
                                                fillColor: "#a8dbf2",
                                                fillOpacity: 1,
                                                color: "#a8dbf2",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '200': return{
                                                fillColor: "#000",
                                                fillOpacity: 0.3,
                                                color: "#000",
                                                opacity: 0

                                            };
                                            case '100': return{
                                                color: "#f6ff8c",
                                                opacity: 1,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 0

                                            };
                                            case '101': return{
                                                color: "#f6ff8c",
                                                opacity: 1,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 0

                                            };
                                            case '99': return{
                                                color: "#f6ff8c",
                                                opacity: 1,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 0

                                            };


                                        }
                                    }
                                }).addTo(map);
                                geojson2 =  L.geoJSON(states4, {
                                    style: function(feature) {
                                        switch (feature.properties.id4) {
                                            case '0': return{
                                                color: "#a8a8a8",
                                                fillColor: "#a8a8a8",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '1': return{
                                                fillColor: "#fff819",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 1

                                            };
                                            case '2': return{

                                                fillColor:"#ffd37f",
                                                color: "#ffd37f",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '3': return{
                                                fillColor:"#ffaa00",
                                                color: "#ffaa00",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '4': return{
                                                fillColor: "#c07242",
                                                color: "#c07242",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0

                                            };
                                            case '5': return{
                                                fillColor: "#9900cc",
                                                color: "#9900cc",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '6': return{
                                                fillColor: "#ffbee8",
                                                fillOpacity: 1,
                                                color: "#ffbee8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '7': return{
                                                fillColor: "#00a69d",
                                                fillOpacity: 1,
                                                color: "#00a69d",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '8': return{
                                                fillColor: "#004da8",
                                                fillOpacity: 1,
                                                color: "#004da8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '9': return{
                                                fillColor: "#96cf00",
                                                fillOpacity: 1,
                                                color: "#96cf00",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '10': return{
                                                fillColor: "#9da15c",
                                                fillOpacity: 1,
                                                color: "#9da15c",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '11': return{
                                                fillColor: "#0cffc7",
                                                fillOpacity: 1,
                                                color: "#0cffc7",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '12': return{
                                                fillColor: "#d8f5c9",
                                                fillOpacity: 1,
                                                color: "#d8f5c9",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '13': return{
                                                fillColor: "#ff0000",
                                                fillOpacity: 1,
                                                color: "#ff0000",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '16': return{
                                                fillColor: "#f987f6",
                                                fillOpacity: 1,
                                                color: "#f987f6",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '40': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '41': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '42': return{
                                                fillColor: "#ffffff",
                                                fillOpacity: 1,
                                                color: "#ffffff",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '44': return{
                                                fillColor: "#dbd9d7",
                                                fillOpacity: 1,
                                                color: "#dbd9d7",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '79': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '80': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '900': return{
                                                fillColor: "#a8dbf2",
                                                fillOpacity: 1,
                                                color: "#a8dbf2",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '200': return{
                                                fillColor: "#000",
                                                fillOpacity: 0.3,
                                                color: "#000",
                                                opacity: 0

                                            };
                                            case '100': return{
                                                color: "#f6ff8c",
                                                opacity: 0,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 1

                                            };
                                            case '101': return{
                                                color: "#f6ff8c",
                                                opacity: 0,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 1

                                            };
                                            case '99': return{
                                                color: "#f6ff8c",
                                                opacity: 0,
                                                fillColor: "#f6ff8c",
                                                fillOpacity: 1

                                            };



                                        }
                                    }

                                }).addTo(map);
                                L.geoJSON(states3, {
                                    style: function(feature) {
                                        switch (feature.properties.id3) {
                                            case '0': return{
                                                color: "#a8a8a8",
                                                fillColor: "#a8a8a8",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '1': return{
                                                fillColor: "#fff819",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 1

                                            };
                                            case '2': return{

                                                fillColor:"#ffd37f",
                                                color: "#ffd37f",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '3': return{
                                                fillColor:"#ffaa00",
                                                color: "#ffaa00",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0
                                            };
                                            case '4': return{
                                                fillColor: "#c07242",
                                                color: "#c07242",
                                                weight: 0,
                                                fillOpacity: 1,
                                                opacity: 0

                                            };
                                            case '5': return{
                                                fillColor: "#9900cc",
                                                color: "#9900cc",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '6': return{
                                                fillColor: "#ffbee8",
                                                fillOpacity: 1,
                                                color: "#ffbee8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '7': return{
                                                fillColor: "#00a69d",
                                                fillOpacity: 1,
                                                color: "#00a69d",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '8': return{
                                                fillColor: "#004da8",
                                                fillOpacity: 1,
                                                color: "#004da8",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '9': return{
                                                fillColor: "#96cf00",
                                                fillOpacity: 1,
                                                color: "#96cf00",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '10': return{
                                                fillColor: "#9da15c",
                                                fillOpacity: 1,
                                                color: "#9da15c",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '11': return{
                                                fillColor: "#0cffc7",
                                                fillOpacity: 1,
                                                color: "#0cffc7",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '12': return{
                                                fillColor: "#d8f5c9",
                                                fillOpacity: 1,
                                                color: "#d8f5c9",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '13': return{
                                                fillColor: "#ff0000",
                                                fillOpacity: 1,
                                                color: "#ff0000",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '16': return{
                                                fillColor: "#f987f6",
                                                fillOpacity: 1,
                                                color: "#f987f6",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '40': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '41': return{
                                                fillColor: "#4e4e4e",
                                                fillOpacity: 1,
                                                color: "#4e4e4e",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '42': return{
                                                fillColor: "#ffffff",
                                                fillOpacity: 1,
                                                color: "#ffffff",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '44': return{
                                                fillColor: "#dbd9d7",
                                                fillOpacity: 1,
                                                color: "#dbd9d7",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '79': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '80': return{
                                                fillColor: "#0a0149",
                                                fillOpacity: 1,
                                                color: "#0a0149",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '900': return{
                                                fillColor: "#a8dbf2",
                                                fillOpacity: 1,
                                                color: "#a8dbf2",
                                                weight: 0,
                                                opacity: 0
                                            };
                                            case '200': return{
                                                fillColor: "#000",
                                                fillOpacity: 0.3,
                                                color: "#000",
                                                opacity: 0

                                            };
                                            case '100': return{
                                                color: "#c57304",
                                                opacity: 1,
                                                fillColor: "#c57304",
                                                fillOpacity: 0

                                            };
                                            case '101': return{
                                                color: "#c57304",
                                                opacity: 1,
                                                fillColor: "#c57304",
                                                fillOpacity: 0

                                            };
                                            case '99': return{
                                                color: "#c57304",
                                                opacity: 1,
                                                fillColor: "#c57304",
                                                fillOpacity: 0

                                            };

                                        }
                                    }

                                }).addTo(map);
                                var myStyle = {
                                    radius: 40,
                                    fillColor: "#000",
                                    color: "#ff1a1a",
                                    weight: 3,
                                    opacity: 1,
                                    fillOpacity: 0
                                };

                               L.geoJSON(states, {
                                    style: myStyle
                                }).addTo(map);

//                                L.geoJson(states4, {
//                                   onEachFeature: function(feature, layer) {
//                                       var label = L.marker(layer.getBounds().getCenter(), {
//                                           icon: L.divIcon({
//                                                className: 'label',
//                                                html: feature.properties.name
//                                            })
//                                        }).addTo(map);
//                                  }
//                              });

                                /*   geojson.eachLayer(function (layer) {
                                    layer.bindPopup(layer.feature.properties.name);
                                });
                               // layer.eachLayer(function(l) { l.showLabel();});


                                geojson2.eachLayer(function (layer) {
                                    layer.bindPopup(layer.feature.properties.name);
                                });
                                map.fitBounds(geojson2.getBounds().getCenter());*/
                                // Creating a Marker



                                var popup = L.popup();

                                function onMapClick(e) {
                                    //alert("You clicked the map at " + e.latlng);
                                    popup
                                        .setLatLng(e.latlng)
                                        .setContent( e.latlng.toString())
                                        .openOn(map);
                                }

                                document.getElementById('download').addEventListener('click', function() {
                                 // cover.className = 'active';
                                    leafletImage(map, downloadMap);
                                });
                                /// je desactive les controles
                              //  map.on('click', onMapClick);
                                map.zoomControl.remove();
                                map.scrollWheelZoom.disable();
                                map.doubleClickZoom.disable();

                                function downloadMap(err, canvas) {
                                    var imgData = canvas.toDataURL("image/png", 1.0);

                                    var dimensions = map.getSize();
                                    var pdf = new jsPDF('landscape', 'mm', 'a4');
                                    pdf.setFontSize(22);
                                    source = $('#test')[0];
                                    specialElementHandlers = {
                                        '#bypassme': function(element, renderer){
                                            return true
                                        }
                                    };

                                    pdf.setFont("arial");
                                    pdf.setFontType("bold");
                                    pdf.setFontSize(20);
                                    pdf.text(100, 30, 'FICHE DE RENSEIGNEMENT');
                                    pdf.setTextColor(255, 0, 0);
                                    pdf.setFontSize(14);
                                    //pdf.text(120, 30, 'Avis de servitude');
                                    pdf.setTextColor(0, 0, 0);
                                    pdf.setFont("calibri");
                                    pdf.setFontSize(8);
                                    pdf.setFontType("italic");
                                    pdf.addImage(imgData, 'JPG', 60, 40,180, 80);
                                    var dt ="NB : Les résultats obtenus à partir de  l  application @AlerteServitude constituent de simples documents d  informations, de conseils et d  assistance. Les informations reçues ne peuvent en aucun cas être considérées comme un document administratif quelconque, ni un certificat d  urbanisme ou un avis de servitude délivré par l  administration. Elles n  ont aucun caractère opposable. Les résultats peuvent être consultés et/ou téléchargés.";
                                    var splittext = pdf.splitTextToSize(dt, 240);
                                    pdf.text(30, 180, splittext, {lang: 'FR'});

                                    pdf.setFontType("regular");
                                    pdf.text(160, 195, "Contacts : +225 22 43 51 88   +225 04 29 24 47", {lang: 'FR'});
                                    pdf.text(230, 195, "Email : info@alertefoncier.ci", {lang: 'FR'});

                                    pdf.text(268, 115, "Copyright @ Alerte-Foncier SARL 2018 - Tous droits reservés ", null,90);
                                   // cover.className = '';
                                    margins = {
                                        top: 10,
                                        left: 30,
                                        width: 180
                                    };
                                    var columns = ["Servitudes observées ", "Conclusion"];
                                    var rows = [
                                        [ "  <?php
                                            // var_dump(array_unique($tab));

                                            if ($result==0){
                                                echo "Hors Périmètre Urbain";
                                            }

                                            if ($count2==0 and $m==1){
                                                echo "Aucune Servitude";
                                            }else{
                                            // echo $count;
                                          foreach ($servitude as $key){
                                              $tc--;

                                              if($tc >0)
                                              {
                                                  echo $key.",  " ;

                                              }else{
                                                  echo $key ;
                                              }
                                          } } ?> ", "<?php
                                            // var_dump(array_unique($tab));
                                            $count3 = count(array_unique($tab));
                                            // echo $count;
                                            switch ($count3) {
                                                case 1:{
                                                    if (in_array("1", array_unique($tab))) {
                                                        echo "Votre parcelle est frappée de servitudes";
                                                    }

                                                    if (in_array("2", array_unique($tab))) {
                                                        echo "Votre Parcelle n' est pas frappée de servitude";
                                                    }
                                                    break;
                                                }
                                                case 2:{

                                                    echo "Votre Parcelle est partiellement frappée de servitude et necessite un redimensionnement en excluant les zones de servitudes";

                                                    break;
                                                }
                                                default:{

                                                    echo "Votre Parcelle  est  frappée de servitude";

                                                    break;
                                                }
                                            }

                                            ?>"]
                                    ];
                                <?php if ($count3==2){ ?>
                                    pdf.setTextColor(255, 0, 0);

                                    pdf.setFont("calibri");
                                    pdf.setFontSize(11);
                                    pdf.setFontType("italic");
                                    pdf.text(40, 165, "Veuillez Nous contacter  pour redimensionner votre parcelle: +225 22 43 51 88 / 04 29 24 47 ou envoyez un email à info@alertefoncier.ci");
                                    <?php }   ?>
                                    pdf.fromHTML(
                                        source // HTML string or DOM elem ref.
                                        , margins.left // x coord
                                        , margins.top // y coord
                                        , {
                                            'width': margins.width // max width of content on PDF
                                            , 'elementHandlers': specialElementHandlers
                                        },
                                        function (dispose) {

                                            pdf.autoTable(columns, rows, {
                                                createdCell: function (cell, data) {
                                                    cell.styles.fillColor = '#ffffff';
                                                },
                                            styles: {overflow: 'linebreak'},
                                                Conclusion: {Color: [155, 89, 182]
                                                },
                                                margin: {top: 127, left:30, right:30},
                                                width:180
                                            });



                                            pdf.save("Fiche de renseignement.pdf");
                                        })
                                }

                            </script>

                        </div>
                        <br />
                    </div><!-- /.End of post content -->
                </div><!--/. End of single blog inner -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.End of our blog -->
<?php  }else{ header("location:index.php?page=connect&id=1"); } ?>