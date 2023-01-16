<?php // Connection à la base de données
//error_reporting(0);

include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['camp'])  ) {
   $periode= $_POST['p'];

    $tab_camp = explode('-',$_POST['camp']);
    $and = intval($tab_camp[0])-1;
    $anf = intval($tab_camp[1])-1;
    $new_an_1= $and."-".$anf;
    /// liste des passage d'un comptage
    function liste_passage($camp,$periode)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rsan = $bdd->prepare("SELECT tb_comptage_cacao.idpassage FROM tb_comptage_cacao,tb_passage WHERE tb_passage.id=tb_comptage_cacao.idpassage and tb_passage.type_periode= :tp AND  an_campagne =:an and tb_comptage_cacao.supp=0  GROUP BY tb_comptage_cacao.idpassage,type_periode ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsan->execute(array("an" => $camp,"tp" => $periode));
        // $rowan = $rsan->rowCount();
        $row = $rsan->fetchAll(PDO::FETCH_ASSOC);
        sort($row);
        return $row;
    }

    function somme_cpte_del($nomtab, $codedp, $idp, $an)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rest = substr($codedp, 0, 3);
        $codeapp = 'K' . $rest;
        //echo "select sum(fruit_a) as x,sum(fruit_b) as y,sum(fruit_c) as r FROM $nomtab where tb_comptage_cacao.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp ";
//echo "select CAST(sum(fe) as float)/count(idpassage)  as x, CAST(sum(flo) as float)/count(idpassage)  as y, CAST(sum(Noue) as float)/count(idpassage)  as r FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and tb_comptage_cacao.supp=0 and tb_comptage_cacao.idpassage=$idp and tb_comptage_cacao.an_campagne ='$an'";
       // echo "select CAST(sum(fe) as float)/count(idpassage)  as x, CAST(sum(flo) as float)/count(idpassage)  as y, CAST(sum(Noue) as float)/count(idpassage)  as r,avg(CAST(sum(fe) as float)/count(idpassage)) as moyx FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and tb_comptage_cacao.supp=0 and tb_comptage_cacao.idpassage=$idp and tb_comptage_cacao.an_campagne ='$an'";
        $rsc = $bdd->prepare("select count(tb_comptage_cacao.pied_code) as p
FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and tb_comptage_cacao.supp=0 and tb_comptage_cacao.idpassage=$idp and tb_comptage_cacao.an_campagne ='$an'");
        $rsc->execute();
        $rowc = $rsc->fetchAll(PDO::FETCH_ASSOC);
        return $rowc;
    }
function somme_cpte_del2($nomtab, $codedp, $idp, $an)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';

             $tab_camp = explode('-',$an);
    $and = intval($tab_camp[0])-1;
    $anf = intval($tab_camp[1])-1;
    $new_an_1= $and."-".$anf;
        //$codeapp = 'K' . $rest;
        //echo "select sum(fruit_a) as x,sum(fruit_b) as y,sum(fruit_c) as r FROM $nomtab where tb_comptage_cacao.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp ";
//echo "select CAST(sum(fe) as float)/count(idpassage)  as x, CAST(sum(flo) as float)/count(idpassage)  as y, CAST(sum(Noue) as float)/count(idpassage)  as r FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and tb_comptage_cacao.supp=0 and tb_comptage_cacao.idpassage=$idp and tb_comptage_cacao.an_campagne ='$an'";
        $rsc = $bdd->prepare("select count(tb_comptage_cacao.pied_code) as p FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and tb_comptage_cacao.supp=0 and tb_comptage_cacao.idpassage=$idp and tb_comptage_cacao.an_campagne ='$new_an_1'");
        $rsc->execute();
        $rowc = $rsc->fetchAll(PDO::FETCH_ASSOC);
        return $rowc;
    }
    function calcul_taux($x,$x1){
        $taux =round(($x/$x1)*100);
        return $taux;
    }



    //echo "Nbre de passage". var_dump(liste_passage($_POST['camp']));
    //$tabliste;
    $tabliste = liste_passage($_POST['camp'],$periode);
    $nbre_decomptage = count($tabliste);
   // sort($tabliste);
  // var_dump($tabliste);
   // echo count($tabliste);
    /*  var_dump($tabliste[0]['idpassage']) ;
       echo "<br>";
       var_dump($tabliste[1]['idpassage']);
      echo "<br>";
       var_dump($tabliste[3]['idpassage']);
      echo "<br>";
       var_dump($tabliste[4]['idpassage']);
       $nbre_decomptage = cnt($tabliste);
       /*
       for ($zm=1; $zm <= $nbre_decomptage; $zm++){
           $tabliste[0];
       }
              */
    ?>


    <div class="row">
    <div class="col-lg-12 input_field_sections table-responsive">

    <div class="input-group">
        <h3 style="text-align: center;font-weight: bold">Vérification des pieds de Cacao  durant la campagne <?php echo  $new_an_1 ?> et <?php echo  $_POST['camp'] ?>  de la periode <?php echo  strtoupper($periode) ?>  </h3>
    <table id="example2" class="table table-striped table-bordered table_res dataTable "  style="font-size: 10px">
    <thead>
    <tr>

        <th rowspan="3" style="vertical-align: middle">Delegations</th>
        <th rowspan="3" style="vertical-align: middle">Département</th>

        <th colspan="<?php echo $nbre_decomptage ?>"> <?php echo  $new_an_1 ?></th>
        <th colspan="<?php echo $nbre_decomptage ?>"> <?php echo  $_POST['camp'] ?></th>


    </tr>
    <tr>

    </tr>
    <tr>
    <?php for ($z = 1; $z <= $nbre_decomptage; $z++) {
        if ($z == 1) {
            $us = 4;
        } elseif ($z == 2) {
            $us = 6;
        } else {
            $us = 7;
        }

        ?>
        <th ><?php echo $z; ?>e Comptage</th>

    <?php } ?>
        <?php for ($z = 1; $z <= $nbre_decomptage; $z++) {
            if ($z == 1) {
                $us = 4;
            } elseif ($z == 2) {
                $us = 6;
            } else {
                $us = 7;
            }

            ?>
            <th ><?php echo $z; ?>e Comptage</th>

        <?php } ?>
    </tr>
    </thead>

    <tbody>
    <?php
    $sqldel = $bdd->prepare("SELECT tb_delegation.code_delegation,tb_delegation.designation FROM tb_delegation,tb_comptage_cacao WHERE tb_comptage_cacao.code_del=code_delegation GROUP BY tb_delegation.code_delegation,tb_delegation.designation ORDER BY tb_delegation.designation ASC  ");
    $sqldel->execute();
    // $rowdel = $sqldel->fetchAll();
    // var_dump($rowdel)
    // var_dump($rowdel)


    while ($rowdel = $sqldel->fetch()) {
        $m = 1;
        $t = 0;
       $somx=$somx1=$somx2=$somx3=$somx4=$somx5=0;
        $somy=$somy1=$somy2=$somy3=$somy4=$somy5=0;
        $somr=$somr1=$somr2=$somr3=$somr4=$somr5=0;
        $somx_=$somx_1=$somx_2=$somx_3=$somx_4=$somx_5=0;
        $somy_=$somy_1=$somy_2=$somy_3=$somy_4=$somy_5=0;
        $somr_=$somr_1=$somr_2=$somr_3=$somr_4=$somr_5=0;

        $tab_sumx = $tab_sumy = $tab_sumr = $tab_sumt =$totx= array();

        $iddel = $rowdel['code_delegation'];


        $sqldep1 = $bdd->prepare("SELECT * FROM tb_departement WHERE delegation_code = :d  and code_departement IN (SELECT tb_comptage_cacao.code_dep  from tb_comptage_cacao WHERE tb_comptage_cacao.code_del='$iddel' and tb_comptage_cacao.supp=0)", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sqldep1->execute(array("d" => $iddel));
        $nbdep = $sqldep1->rowCount();


        /**/ ?>
        <tr>
            <th rowspan="<?php echo $nbdep + 2 ?>"
                style="vertical-align: middle"><?php echo $rowdel['designation']; ?>
            </th>
        </tr>

        <?php while ($rowdp = $sqldep1->fetch()) {

            $codedep = $rowdp['code_departement'];
           // $totx=0;
            $tt =$tt_=0;
            for ($zt = 1; $zt <= $nbre_decomptage; $zt++) {
                $mz = $zt - 1;



                if ($zt == 1) {
                    $list1 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[0]['idpassage'], $_POST['camp']);
                   // var_dump($list1);
                    $list_1 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[0]['idpassage'], $_POST['camp']);

                }
             if ($zt == 2) {
                    $list2 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[1]['idpassage'], $_POST['camp']);
                    $list_2 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[1]['idpassage'], $_POST['camp']);
                }
                if ($zt == 3) {
                    $list3 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[2]['idpassage'], $_POST['camp']);
                    $list_3 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[2]['idpassage'], $_POST['camp']);

                }
                if ($zt == 4) {
                    $list4 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[3]['idpassage'], $_POST['camp']);
                    $list_4 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[3]['idpassage'], $_POST['camp']);

                }
                if ($zt == 5) {
                    $list5 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[4]['idpassage'], $_POST['camp']);
                    $list_5 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[4]['idpassage'], $_POST['camp']);

                }
                if ($zt == 6) {
                    $list6 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[5]['idpassage'], $_POST['camp']);
                    $list_6 = somme_cpte_del2('tb_comptage_cacao', $codedep, $tabliste[5]['idpassage'], $_POST['camp']);

                }
                   /**/


            }

            ?>
            <tr>
                <th><?php echo $rowdp['designation']; ?></th>
            <?php
          //  $totx=0;


            for ($ztn = 1; $ztn <= $nbre_decomptage; $ztn++) {
                ?>
                <?php if($ztn == 1){ ?>
                    <th><?php echo $ttt= $list1[0]['p'];
                     $totx[$tt] = floatval($ttt) ;
                        ?></th>

                <?php }elseif($ztn == 2){ ?>
                    <th><?php echo  $list2[0]['p'];    $totx2[$tt] = $list2[0]['p'] ; ?></th>

          <?php }elseif($ztn == 3){ ?>
                    <th><?php echo $list3[0]['p']; $totx3[$tt] = $list3[0]['p'] ; ?></th>
                       <?php }elseif($ztn == 4){ ?>
                    <th><?php echo $list4[0]['p']; $totx4[$tt] = $list4[0]['p'] ; ?></th>
                 <?php }elseif($ztn == 5){ ?>
                    <th ><?php echo $list5[0]['p']; $totx5[$tt] = $list5[0]['p'] ;  ?></th>
                <?php }elseif($ztn == 6){ ?>
                    <th ><?php echo $list6[0]['p']; $totx6[$tt] = $list6[0]['p'] ;  ?></th>
            <?php } }

            for ($ztn_1 = 1; $ztn_1 <= $nbre_decomptage; $ztn_1++) {
            ?>
            <?php if($ztn_1 == 1){ ?>
                <th><?php echo $ttt_= $list_1[0]['p'];
                    $totx_[$tt_] = $ttt_ ;

                    ?></th>


            <?php }elseif($ztn_1 == 2){ ?>
                <th><?php echo  $list_2[0]['p'];    $totx_2[$tt] = $list_2[0]['p'] ; ?></th>

            <?php }elseif($ztn_1 == 3){ ?>
                <th><?php echo  $list_3[0]['p']; $totx_3[$tt] = $list_3[0]['p'] ; ?></th>
            <?php }elseif($ztn_1 == 4){ ?>
                    <th><?php echo  $list_4[0]['p']; $totx_4[$tt] = $list_4[0]['p'] ; ?></th>
            <?php }elseif($ztn_1 == 5){ ?>
                    <th><?php echo  $list_5[0]['p']; $totx_5[$tt] = $list_5[0]['p'] ; ?></th>

            <?php }elseif($ztn_1 == 6){ ?>
                    <th><?php echo  $list_6[0]['p']; $totx_6[$tt] = $list_6[0]['p'] ; ?></th>
            <?php } }  ?>
              </tr>
        <?php
            if (isset($list1)) $somx +=  $list1[0]['p'];
            if (isset($list2)) $somx1 +=  $list2[0]['p'];
            if (isset($list3))   $somx2 +=  $list3[0]['p'];
            if (isset($list4))$somx3 +=  $list4[0]['p'];
            if (isset($list5))$somx4 +=  $list5[0]['p'];
            if (isset($list6))$somx5 +=  $list6[0]['p'];


            if (isset($list_1)) $somx_ +=  $list_1[0]['p'];
            if (isset($list_2)) $somx_1 +=  $list_2[0]['p'];
            if (isset($list_3))   $somx_2 +=  $list_3[0]['p'];
            if (isset($list_4))$somx_3 +=  $list_4[0]['p'];
            if (isset($list_5))$somx_4 +=  $list_5[0]['p'];
            if (isset($list_6))$somx_5 +=  $list_6[0]['p'];




            //$somx2 +=  $list2[0]['x'];
        // echo   array_sum($totx[0])/count($totx[0]) ;
            $m++;
            $t++;$tt++;$tt_++; } ?>
<tr style="vertical-align: middle;background-color: darkred; color: white">
    <th> TOTAL <?php echo $rowdel['designation']; ?></th>
        <?php

        for ($mzz = 1; $mzz <= $nbre_decomptage; $mzz++) {?>

            <?php if($mzz == 1){ ?>
                <th><?php echo $somx ; ?></th>

            <?php   }elseif($mzz == 2){ ?>
                <th><?php echo $somx1 ; ?></th>

            <?php   }elseif($mzz == 3){ ?>
                <th><?php echo $somx2 ; ?></th>

            <?php   }else if($mzz == 4){ ?>
                <th><?php echo $somx3 ; ?></th>

            <?php   }else if($mzz == 5){ ?>
                <th><?php echo $somx4 ; ?></th>

            <?php   }else if($mzz == 6){ ?>
                <th><?php echo $somx5 ; ?></th>

            <?php   }else{}} ?>
    <?php

        for ($mzz_ = 1; $mzz_ <= $nbre_decomptage; $mzz_++) {?>

            <?php if($mzz_ == 1){ ?>
                <th><?php echo $somx_ ; ?></th>

            <?php   }elseif($mzz_ == 2){ ?>
                <th><?php echo $somx_1 ; ?></th>

            <?php   }elseif($mzz_ == 3){ ?>
                <th><?php echo $somx_2 ; ?></th>

            <?php   }else if($mzz_ == 4){ ?>
                <th><?php echo $somx_3 ; ?></th>

            <?php   }else if($mzz_ == 5){ ?>
                <th><?php echo $somx_4 ; ?></th>

            <?php   }else if($mzz_ == 6){ ?>
                <th><?php echo $somx_5 ; ?></th>

            <?php   }else{}} ?>
</tr>
<?php  } ?>

        </tbody>
        </table>
        </div>
        </div>
        </div>
        <?php

}
?>