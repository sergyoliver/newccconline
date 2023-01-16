<link type="text/css" rel="stylesheet" href="../vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/inputlimiter/css/jquery.inputlimiter.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/chosen/css/chosen.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/jquery-tagsinput/css/jquery.tagsinput.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/daterangepicker/css/daterangepicker.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/datepicker/css/bootstrap-datepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="../vendors/fileinput/css/fileinput.min.css"/>
<link type="text/css" rel="stylesheet" href="../css/pages/form_elements.css"/>
<link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
<style>
    @media print {

        body * {
            visibility: hidden;
        -webkit-print-color-adjust: exact !important;

        }

.head{
    display: none;
}
        #printBtn {
           visibility: hidden;
        }

        #bloc {
            visibility: hidden;
        }
        #v,#ok2 {
            visibility: hidden;
        }

        #bloc3{  visibility: hidden;
        }
 #bloc2{  visibility: visible;
        }



    }
</style>
<header class="head">
    <div class="main-bar row">
        <div class="col-xs-6">
            <h4 class="m-t-5">
                <i class="fa fa-home"></i>
                Dashboard
            </h4>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row" id="bloc2">
            <div class="col-xl-12 col-lg-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <div class="bg-primary top_cards">
                            <div class="row icon_margin_left">

                                <div class="col-lg-5 icon_padd_left">
                                    <div class="float-xs-left">
                                    <span class="fa-stack fa-sm">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-braille fa-stack-1x fa-inverse text-primary sales_hover"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 icon_padd_right">
                                    <div class="float-xs-right cards_content">
                                        <span class="number_val" id="widget_count5"><?php //echo number_format($nbtotenr) ?></span>
                                        <br>
                                        <span class="card_description">Nb.Total Enrolés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class=" top_cards" style="background-color: #EF0D1C; color: white">
                            <div class="row icon_margin_left">
                                <div class="col-lg-5 icon_padd_left">
                                    <div class="float-xs-left">
                            <span class="fa-stack fa-sm">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-braille fa-stack-1x fa-inverse text-danger visit_icon"></i>
                            </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 icon_padd_right">
                                    <div class="float-xs-right cards_content">
                                        <span class="number_val" id="visitors_count"><?php //echo number_format($nbag) ?></span>
                                        <br>
                                        <span class="card_description">Nb. Total Agent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class=" top_cards" style="background-color: #EF0D1C; color: white">
                            <div class="row icon_margin_left">
                                <div class="col-lg-5 icon_padd_left">
                                    <div class="float-xs-left">
                            <span class="fa-stack fa-sm">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-braille fa-stack-1x fa-inverse text-danger visit_icon"></i>
                            </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 icon_padd_right">
                                    <div class="float-xs-right cards_content">
                                        <span class="number_val" id="visitors_count"><?php //echo number_format($nbag) ?></span>
                                        <br>
                                        <span class="card_description">Nb. Total Agent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <div class="row" id="bloc2" >
            <div class="col-lg-6 col-xs-6 m-t-25 m-t-25">
                <div class="card " >
                    <div class="card-header bg-warning">
                        <i class="fa fa-table"></i> Importé données
                    </div>


                    <div class="card-block" >
                        <div class="col-lg-4  ">
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h5>Joindre fiche excel</h5>
                                    <div class="input-group">
                                        <input id="input-41" name="photopl" type="file"  class="file-loading"  style="display: block">

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 push-lg-5">
                        <button class="btn btn-primary" id="ok2"  name="ok">
                            <i class="fa fa-zoom"></i>
                            Valider
                        </button>


                    </div>



                    <div class="card-block" >


                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-xs-6 m-t-25 m-t-25">
                <div class="card " >
                    <div class="card-header bg-warning">
                        <i class="fa fa-table"></i> Historique des données importés
                    </div>


                    <div class="card-block" id="v">


                    </div>







                </div>
            </div>


        </div>
        <div class="row" id="bloc">
            <div class="col-xl-12 col-lg-12 col-xs-12">

            <div class="row">
            <div class="col-xl-12 col-lg-12 col-xs-12 stat_align">
                <div class="card  top_cards">
                    <div class="card-header bg-info">
                        Requête sur la map
                    </div>
                    <div class="card-body">
                        <div class="row m-t-15" id="bloc">

                            <div class="col-xl-2 col-lg-2 col-xs-2 stat_align"></div>
                            <div class="col-xl-6 col-lg-6 col-xs-12 stat_align">

                                <h5>Agences </h5>
                                <div class="input-group">
                                    <select class="form-control chzn-select" name="zoneid" id="agenceid" onchange="affichem()" >
                                        <option selected disabled value="">Choisir agence </option>

                                        <?php
                                        $i=1;
                                        $rsz = $bdd->prepare("SELECT * FROM agence   ORDER by libelle_com asc ");
                                        $rsz->execute();
                                        while($rowz = $rsz->fetch()) {
                                            ?>
                                            <option value="<?php echo $rowz['id_commune'] ?>" ><?php echo $rowz['libelle_com'] ?></option>

                                        <?php }  ?>

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row m-t-15" id="bloc">

                            <div class="col-xl-6 col-lg-6 col-xs-12 stat_align">

                                <h5>Agences </h5>
                                <div class="input-group">
                                    
                                </div>
                        </div>

                        <div class="table-responsive m-t-35" >
                        <?php include 'map.php'?>

                        </div>

                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>




        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!--<script src="../assets/js/jquery-3.3.1.min.js"></script>-->
<script type="text/javascript" src="../js/components.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
<script src="js/jspdft.min.js?v1632756685"></script>
<script src="js/jspdf.plugin.autotable.js?v1632756685"></script>

<script type="text/javascript" src="../vendors/raphael/js/raphael-min.js"></script>
<script type="text/javascript" src="../vendors/justgage/js/justgage.js"></script>
<script type="text/javascript" src="../vendors/d3/js/d3.min.js"></script>
<script type="text/javascript" src="../vendors/c3/js/c3.min.js"></script>

<script>
    // add in your javaScript



//    new CountUp("widget_count1", 0, 2436, 0, 2.5, options).start();
    function remplirtab(){

            var xhr2;
            var form_data2 = new FormData();

            form_data2.append("z", $('#zone').val());
            form_data2.append("dt", $('#dp1').val());
            form_data2.append("ag", $('#ag').val());

            if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
            else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
            xhr2.open('POST', "tablostat.php", true);
            xhr2.send(form_data2);
            xhr2.onreadystatechange = function() {
                if (xhr2.readyState == 4 && xhr2.status == 200) {
                    var json = $.parseJSON(this.responseText);
                   // console.log(json.simple);
                    document.getElementById("simple").innerHTML =json.simple;
                    document.getElementById("dp").innerHTML =json.dp;
                    document.getElementById("ap").innerHTML =json.ap;
                    document.getElementById("cgc").innerHTML =json.cgc;
                    document.getElementById("orm").innerHTML =json.orm;
                    $('#simple1').val(json.simple);

                    //                document.getElementById("retourajprix").innerHTML = this.responseText;
                }
                if (xhr2.readyState == 4 && xhr2.status != 200) {
                    alert("Error : returned status code " + xhr2.status);
                }
            }

        }

   function affiche() {
       var xhr2;
       var form_data2 = new FormData();

       form_data2.append("z", $('#zone').val());
       form_data2.append("dt", $('#dp1').val());
       form_data2.append("dt2", $('#dp2').val());
       form_data2.append("ag", $('#ag').val());

       if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
       else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
       xhr2.open('POST', "tablostat.php", true);
       xhr2.send(form_data2);
       xhr2.onreadystatechange = function() {
           if (xhr2.readyState == 4 && xhr2.status == 200) {
               var json = $.parseJSON(this.responseText);
               // console.log(json.simple);
               document.getElementById("ve").innerHTML =json.vendeur;
               document.getElementById("a").innerHTML =json.acheteur;
              // document.getElementById("ap").innerHTML =json.ap;
               //document.getElementById("cgc").innerHTML =json.cgc;
              // document.getElementById("orm").innerHTML =json.orm;
//               $('#simple1').val(json.simple);

               // Donut chart
               var chart1 = c3.generate({
                   bindto: '#chart1',
                   data: {
                       columns: [
                           ['data1', 10],
                           ['data2', 130]
                       ],
                       type: 'donut'
                   },
                   donut: {
                       title: "Repartition "
                   },
                   color: {
                       pattern: ['#D23DF2', '#0fb0c0', '#13B631', '#ffb300', '#d1a47a']
                   }
               });

               setTimeout(function () {
                   chart1.load({
                       columns: [
                          ["ORM Vendeur", json.vendeur],
                           ["ORM Acheteur", json.acheteur]

                       ]
                   });
               }, 1500);

               setTimeout(function () {
                   chart1.unload({
                       ids: 'data1'
                   });
                   chart1.unload({
                       ids: 'data2'
                   });
               }, 2500);
               //                document.getElementById("retourajprix").innerHTML = this.responseText;
           }
           if (xhr2.readyState == 4 && xhr2.status != 200) {
               alert("Error : returned status code " + xhr2.status);
           }
       }

   }
   function visualiser() {
       var xhr2;
       var form_data2 = new FormData();
       var t="";

       form_data2.append("dtdb", $('#dp3').val());
       form_data2.append("dtfin", $('#dp4').val());


       if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
       else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
       xhr2.open('POST', "affichenb.php", true);
       xhr2.send(form_data2);
       xhr2.onreadystatechange = function() {
           if (xhr2.readyState == 4 && xhr2.status == 200) {
               var json = $.parseJSON(this.responseText);
               // console.log(json.simple);
//               document.getElementById("simple").innerHTML =json.simple;
//               document.getElementById("dp").innerHTML =json.dp;
//               document.getElementById("ap").innerHTML =json.ap;
//               document.getElementById("cgc").innerHTML =json.cgc;
//               document.getElementById("orm").innerHTML =json.orm;
//               $('#simple1').val(json.simple);

               if ($('#dp3').val()===$('#dp4').val()){
                   t = 'Ce jour : '+$('#dp3').val();
               }else{
               t = 'durant la période du : '+$('#dp3').val()+' au '+$('#dp4').val();
               }
                document.getElementById("infonb").innerHTML ='<div class="bg-warning top_cards">'
                   +'<div class="row icon_margin_left"> <div class="col-lg-2 icon_padd_left"> <div class="float-xs-left">'
                   +'<span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-braille fa-stack-1x fa-inverse text-warning revenue_icon"></i>'
                   +'</span> </div> </div> <div class="col-lg-10 icon_padd_right"> <div class="float-xs-right cards_content" >'
                   +'<span class="number_val" id="revenue_count">'+this.responseText+'</span><i class="fa fa-bell fa-2x"></i> <br> <span class="card_description">Personnes enrolés '+ t +'</span></div> </div> </div> </div>' ;
           }
           if (xhr2.readyState == 4 && xhr2.status != 200) {
               alert("Error : returned status code " + xhr2.status);
           }
       }

   }
   function affichem() {

       var xhr2;
       var form_data2 = new FormData();

       form_data2.append("ag", $('#agenceid').val());


       if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
       else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
       xhr2.open('POST', "affichem.php", true);
       xhr2.send(form_data2);
       xhr2.onreadystatechange = function() {
           if (xhr2.readyState == 4 && xhr2.status == 200) {

               document.getElementById("idtabag").innerHTML =this.responseText ;
           }
           if (xhr2.readyState == 4 && xhr2.status != 200) {
               alert("Error : returned status code " + xhr2.status);
           }
       }

   }

</script>

<!-- end of plugin script -->
<!--<script type="text/javascript" src="../js/pages/advanced_charts.js"></script>-->