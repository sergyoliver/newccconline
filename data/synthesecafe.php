<?php // Connection à la base de données
//error_reporting(0);

include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['camp'])  ) {
   $periode= $_POST['p'];


    /// liste des passage d'un comptage
    function liste_passage($camp,$periode)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rsan = $bdd->prepare("SELECT idpassage FROM tb_comptage_cafe,tb_passage WHERE tb_passage.id=tb_comptage_cafe.idpassage and tb_passage.type_periode= :tp AND  an_campagne =:an  GROUP BY idpassage,type_periode ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsan->execute(array("an" => $camp,"tp" => $periode));
       // $rowan = $rsan->rowCount();
        $row = $rsan->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function somme_cpte_del($nomtab, $codedp, $idp, $an)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rest = substr($codedp, 0, 3);
        $codeapp = 'C' . $rest;
        //echo "select sum(fruit_a) as x,sum(fruit_b) as y,sum(fruit_c) as r FROM $nomtab where tb_comptage_cacao.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp ";

        $rsc = $bdd->prepare("select sum(grappe) as x,sum(fruit) as y, sum(grappe+fruit) as t FROM $nomtab where tb_comptage_cafe.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp and an_campagne ='$an'");
        $rsc->execute();
        $rowc = $rsc->fetchAll(PDO::FETCH_ASSOC);
        return asort($rowc);
    }

    function somme_cpte_poid($nomtab, $codedp, $idp, $an)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rest = substr($codedp, 0, 3);
        $codeapp = 'C' . $rest;
        // echo "select avg(pese_f) as p FROM $nomtab where tb_comptage_cacao.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp";

        $rsp = $bdd->prepare("select sum(peseF) as p FROM $nomtab where tb_comptage_cafe.parcelle_code like '$codeapp%' and supp=0 and idpassage=$idp and an_campagne ='$an'");
        $rsp->execute();
        $rowp = $rsp->fetchAll(PDO::FETCH_ASSOC);
        return $rowp;
    }

    //echo "Nbre de passage". var_dump(liste_passage($_POST['camp']));
    $tabliste = liste_passage($_POST['camp'],$periode);
    //var_dump($tabliste);
   // echo count($tabliste);
    $nbre_decomptage = count($tabliste);
    /*
    for ($zm=1; $zm <= $nbre_decomptage; $zm++){
        $tabliste[0];
    }
           */
    ?>


    <div class="row">
    <div class="col-lg-12 input_field_sections table-responsive">

    <div class="input-group">
        <h3 style="text-align: center;font-weight: bold">Synthèse des fruits de café collectés durant la campagne <?php echo  $_POST['camp'] ?>  de la periode <?php echo  strtoupper($periode) ?>  </h3>
    <table id="example2" class="table table-striped table-bordered table_res dataTable " >
    <thead>
    <tr>

        <th rowspan="2" style="vertical-align: middle">Delegations</th>
        <th rowspan="2" style="vertical-align: middle">Département</th>

        <?php for ($z = 1; $z <= $nbre_decomptage; $z++) {
            if ($z == 1) {
                $us = 4;
            } elseif ($z == 2) {
                $us = 6;
            } else {
                $us = 7;
            }

            ?>
            <th colspan="<?php echo $us; ?>"><?php echo $z; ?>e Comptage</th>
        <?php } ?>


    </tr>
    <tr>
        <?php for ($z1 = 1; $z1 <= $nbre_decomptage; $z1++) {
            if ($z1 == 1) {
                ?>
                <th>X<?php echo $z1; ?></th>
                <th>Y<?php echo $z1; ?></th>
                <th>R<?php echo $z1; ?></th>
                <th>T<?php echo $z1; ?></th>
                <?php
            } elseif ($z1 == 2) {
                $z12 = $z1;
                ?>
                <th>X<?php echo $z1; ?></th>
                <th>Y<?php echo $z1; ?></th>
                <th>R<?php echo $z1; ?></th>
                <th>T<?php echo $z1; ?></th>
                <th>D<?php echo $z12 - 1; ?></th>
                <th>R'<?php echo $z12 - 1; ?></th>
                <?php

            } else {
                $z13 = $z1;
                ?>
                <th>X<?php echo $z1; ?></th>
                <th>Y<?php echo $z1; ?></th>
                <th>R<?php echo $z1; ?></th>
                <th>T<?php echo $z1; ?></th>
                <th>D<?php echo $z13 - 1; ?></th>
                <th>R'<?php echo $z13 - 1; ?></th>
                <th>P<?php echo $z1 - 2; ?></th>

            <?php }
            ?>

        <?php } ?>


    </tr>
    </thead>

    <tbody>
    <?php
    $sqldel = $bdd->prepare("SELECT * FROM tb_delegation ORDER BY tb_delegation.designation ASC  ");
    $sqldel->execute();
    // $rowdel = $sqldel->fetchAll();
    // var_dump($rowdel)


    while ($rowdel = $sqldel->fetch()) {
        $m = 1;
        $t = 0;
        $tab_sumx = $tab_sumy = $tab_sumr = $tab_sumt = array();

        $iddel = $rowdel['code_delegation'];
        $sqldep = $bdd->prepare("SELECT * FROM tb_departement WHERE delegation_code = :d ");
        $sqldep->execute(array("d" => $iddel));

        $sqldep1 = $bdd->prepare("SELECT * FROM tb_departement WHERE delegation_code = :d ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sqldep1->execute(array("d" => $iddel));
        $nbdep = $sqldep1->rowCount();


        /**/ ?>
        <tr>
            <th rowspan="<?php echo $nbdep + 2 ?>"
                style="vertical-align: middle"><?php echo $rowdel['designation']; ?>
            </th>
        </tr>

        <?php while ($rowdp = $sqldep->fetch()) {

            $codedep = $rowdp['designation'];

            for ($zt = 1; $zt <= $nbre_decomptage; $zt++) {
                $mz = $zt - 1;

                if ($zt == 1) {
                    $list1 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[0]['idpassage'], $_POST['camp']);
                }
                if ($zt == 2) {
                    $list2 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[1]['idpassage'], $_POST['camp']);
                }
                if ($zt == 3) {
                    $list3 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[2]['idpassage'], $_POST['camp']);
                    $listp3 = somme_cpte_poid('tb_comptage_cacao', $codedep, $tabliste[2]['idpassage'], $_POST['camp']);
                }
                if ($zt == 4) {
                    $list4 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[3]['idpassage'], $_POST['camp']);
                    $listp4 = somme_cpte_poid('tb_comptage_cacao', $codedep, $tabliste[3]['idpassage'], $_POST['camp']);
                }
                if ($zt == 5) {
                    $list5 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[4]['idpassage'], $_POST['camp']);
                    $listp5 = somme_cpte_poid('tb_comptage_cacao', $codedep, $tabliste[4]['idpassage'], $_POST['camp']);
                }
                if ($zt == 6) {
                    $list6 = somme_cpte_del('tb_comptage_cacao', $codedep, $tabliste[5]['idpassage'], $_POST['camp']);
                    $listp6 = somme_cpte_poid('tb_comptage_cacao', $codedep, $tabliste[5]['idpassage'], $_POST['camp']);
                }


                if ($zt == 1) {
                    $tab_sumx[$t] = $list1[0]['x'];
                    $tab_sumy[$t] = $list1[0]['y'];
                    $tab_sumr[$t] = $list1[0]['r'];
                    $tab_sumt[$t] = $list1[0]['t'];
                } elseif ($zt == 2) {
                    $tab_sumx2[$t] = $list2[0]['x'];
                    $tab_sumy2[$t] = $list2[0]['y'];
                    $tab_sumr2[$t] = $list2[0]['r'];
                    $tab_sumt2[$t] = $list2[0]['t'];
                    $tab_sumd1[$t] = $list2[0]['d'];
                    $tab_sumtr1[$t] = $list1[0]['r'] - $list2[0]['d'];
                } elseif ($zt == 3) {
                    $tab_sumx3[$t] = $list3[0]['x'];
                    $tab_sumy3[$t] = $list3[0]['y'];
                    $tab_sumr3[$t] = $list3[0]['r'];
                    $tab_sumt3[$t] = $list3[0]['t'];
                    $tab_sumd2[$t] = $list3[0]['d'];
                    $tab_sumtr2[$t] = $list2[0]['r'] - $list3[0]['d'];
                    $tab_sumtp1[$t] = round($listp3[0]['p'], 2);
                } elseif ($zt == 4) {
                    $tab_sumx4[$t] = $list4[0]['x'];
                    $tab_sumy4[$t] = $list4[0]['y'];
                    $tab_sumr4[$t] = $list4[0]['r'];
                    $tab_sumt4[$t] = $list4[0]['t'];
                    $tab_sumd3[$t] = $list4[0]['d'];
                    $tab_sumtr3[$t] = $list3[0]['r'] - $list4[0]['d'];
                    $tab_sumtp2[$t] = round($listp4[0]['p'], 2);
                } elseif ($zt == 5) {
                    $tab_sumx5[$t] = $list5[0]['x'];
                    $tab_sumy5[$t] = $list5[0]['y'];
                    $tab_sumr5[$t] = $list5[0]['r'];
                    $tab_sumt5[$t] = $list5[0]['t'];
                    $tab_sumd4[$t] = $list5[0]['d'];
                    $tab_sumtr4[$t] = $list4[0]['r'] - $list5[0]['d'];
                    $tab_sumtp3[$t] = round($listp5[0]['p'], 2);
                } else {
                    $tab_sumx6[$t] = $list6[0]['x'];
                    $tab_sumy6[$t] = $list6[0]['y'];
                    $tab_sumr6[$t] = $list6[0]['r'];
                    $tab_sumt6[$t] = $list6[0]['t'];
                    $tab_sumd5[$t] = $list6[0]['d'];
                    $tab_sumtr5[$t] = $list5[0]['r'] - $list6[0]['d'];
                    $tab_sumtp4[$t] = round($listp6[0]['p'], 2);
                }


            }
            ?>
            <tr>
                <th><?php echo $rowdp['designation']; ?></th>
            <?php
            for ($ztn = 1; $ztn <= $nbre_decomptage; $ztn++) {
                if ($ztn == 1) { ?>
                    <th><?php echo $list1[0]['x']; ?></th>
                    <th><?php echo $list1[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list1[0]['r']; ?></th>
                    <th><?php echo $list1[0]['t']; ?></th>
                     <?php } elseif ($ztn == 2) { ?>
                    <th><?php echo $list2[0]['x']; ?></th>
                    <th><?php echo $list2[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list2[0]['r']; ?></th>
                    <th><?php echo $list2[0]['t']; ?></th>
                    <th><?php echo $list2[0]['d']; ?></th>
                    <th style="color: red"><?php echo $list1[0]['r'] - $list2[0]['d']; ?></th>
                <?php } elseif ($ztn == 3) {
                    ?>
                    <th><?php echo $list3[0]['x']; ?></th>
                    <th><?php echo $list3[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list3[0]['r']; ?></th>
                    <th><?php echo $list3[0]['t']; ?></th>
                    <th><?php echo $list3[0]['d']; ?></th>
                    <th style="color: red"><?php echo $list2[0]['r'] - $list3[0]['d']; ?></th>
                    <th><?php echo round($listp3[0]['p'], 2); ?></th>
                <?php } elseif ($ztn == 4) { ?>
                    <th><?php echo $list4[0]['x']; ?></th>
                    <th><?php echo $list4[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list4[0]['r']; ?></th>
                    <th><?php echo $list4[0]['t']; ?></th>
                    <th><?php echo $list4[0]['d']; ?></th>
                    <th style="color: red"><?php echo $list3[0]['r'] - $list4[0]['d']; ?></th>
                    <th><?php echo round($listp4[0]['p'], 2); ?></th>
                <?php } elseif ($ztn == 5) { ?>
                    <th><?php echo $list5[0]['x']; ?></th>
                    <th><?php echo $list5[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list5[0]['r']; ?></th>
                    <th><?php echo $list5[0]['t']; ?></th>
                    <th><?php echo $list5[0]['d']; ?></th>
                    <th style="color: red"><?php echo $list4[0]['r'] - $list5[0]['d']; ?></th>
                    <th><?php echo round($listp5[0]['p'], 2); ?></th>
                <?php } elseif ($ztn == 6) { ?>
                    <th><?php echo $list6[0]['x']; ?></th>
                    <th><?php echo $list6[0]['y']; ?></th>
                    <th style="color: black"><?php echo $list6[0]['r']; ?></th>
                    <th><?php echo $list6[0]['t']; ?></th>
                    <th><?php echo $list6[0]['d']; ?></th>
                    <th style="color: red"><?php echo $list5[0]['r'] - $list6[0]['d']; ?></th>
                    <th><?php echo round($listp6[0]['p'], 2); ?></th>
                <?php }else {} ?>
            <?php } ?>
              </tr>
        <?php
            $m++;
            $t++; } ?>
<tr style="vertical-align: middle;background-color: darkred; color: white">
    <th> TOTAL <?php echo $rowdel['designation']; ?></th>
    <?php for ($mzz = 1; $mzz <= $nbre_decomptage; $mzz++) {
        if ($mzz == 1) { ?>
            <th><?php echo array_sum($tab_sumx); ?></th>
            <th><?php echo array_sum($tab_sumy); ?></th>
            <th><?php echo array_sum($tab_sumr); ?></th>
            <th><?php echo array_sum($tab_sumt); ?></th>
        <?php } elseif ($mzz == 2) { ?>
            <th><?php echo array_sum($tab_sumx2); ?></th>
            <th><?php echo array_sum($tab_sumy2); ?></th>
            <th><?php echo array_sum($tab_sumr2); ?></th>
            <th><?php echo array_sum($tab_sumt2); ?></th>
            <th><?php echo array_sum($tab_sumd1); ?></th>
            <th><?php echo array_sum($tab_sumtr1); ?></th>
        <?php } elseif ($mzz == 3) { ?>
            <th><?php echo array_sum($tab_sumx3); ?></th>
            <th><?php echo array_sum($tab_sumy3); ?></th>
            <th><?php echo array_sum($tab_sumr3); ?></th>
            <th><?php echo array_sum($tab_sumt3); ?></th>
            <th><?php echo array_sum($tab_sumd2); ?></th>
            <th><?php echo array_sum($tab_sumtr2); ?></th>
            <th><?php echo array_sum($tab_sumtp1); ?></th>
        <?php } elseif ($mzz == 4) { ?>
            <th><?php echo array_sum($tab_sumx4); ?></th>
            <th><?php echo array_sum($tab_sumy4); ?></th>
            <th><?php echo array_sum($tab_sumr4); ?></th>
            <th><?php echo array_sum($tab_sumt4); ?></th>
            <th><?php echo array_sum($tab_sumd3); ?></th>
            <th><?php echo array_sum($tab_sumtr3); ?></th>
            <th><?php echo array_sum($tab_sumtp2); ?></th>
        <?php } elseif ($mzz == 5) { ?>
            <th><?php echo array_sum($tab_sumx5); ?></th>
            <th><?php echo array_sum($tab_sumy5); ?></th>
            <th><?php echo array_sum($tab_sumr5); ?></th>
            <th><?php echo array_sum($tab_sumt5); ?></th>
            <th><?php echo array_sum($tab_sumd4); ?></th>
            <th><?php echo array_sum($tab_sumtr4); ?></th>
            <th><?php echo array_sum($tab_sumtp3); ?></th>
        <?php } elseif ($mzz == 6) { ?>
            <th><?php echo array_sum($tab_sumx6); ?></th>
            <th><?php echo array_sum($tab_sumy6); ?></th>
            <th><?php echo array_sum($tab_sumr6); ?></th>
            <th><?php echo array_sum($tab_sumt6); ?></th>
            <th><?php echo array_sum($tab_sumd5); ?></th>
            <th><?php echo array_sum($tab_sumtr5); ?></th>
            <th><?php echo array_sum($tab_sumtp4); ?></th>
        <?php } else {}   } ?>
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