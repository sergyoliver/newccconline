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
        $rsan = $bdd->prepare("SELECT tb_comptage_cacao.idpassage FROM tb_comptage_cacao,tb_passage WHERE tb_passage.id=tb_comptage_cacao.idpassage and tb_passage.type_periode= :tp AND  an_campagne =:an and tb_comptage_cacao.supp=0  GROUP BY tb_comptage_cacao.idpassage,type_periode ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsan->execute(array("an" => $camp,"tp" => $periode));
        // $rowan = $rsan->rowCount();
        $row = $rsan->fetchAll(PDO::FETCH_ASSOC);
        sort($row);
        return $row;
    }

    function somme_cpte_del($nomtab, $codedp, $an,$idp)
    {
        include '../connexion/connectpg.php';
        // include '../connexion/function.php';
        $rest = substr($codedp, 0, 3);
        $codeapp = 'K' . $rest;
        /*echo "select CAST(sum(fruit_a) as float)/count(tb_comptage_cacao.pied_code)  as moya,
        FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and idpassage='$idp' and tb_comptage_cacao.supp=0  and tb_comptage_cacao.an_campagne ='$an'";

        echo "select CAST(sum(fruit_a) as float)/count(tb_comptage_cacao.pied_code)  as moya
        FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and idpassage='$idp' and tb_comptage_cacao.supp=0  
        and tb_comptage_cacao.an_campagne ='$an'";
        */
        $rsc = $bdd->prepare("select sum(fruit_a) /count(tb_comptage_cacao.pied_code)  as moya,
        count(tb_comptage_cacao.pied_code) as nb
        FROM $nomtab where tb_comptage_cacao.code_dep = '$codedp' and idpassage='$idp' and tb_comptage_cacao.supp=0  
        and tb_comptage_cacao.an_campagne ='$an'");
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
  //var_dump($tabliste);
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
        <h3 style="text-align: center;font-weight: bold">Vérification des pieds de Cacao  durant la campagne  <?php echo  $_POST['camp'] ?>  de la periode <?php echo  strtoupper($periode) ?>  </h3>
    <table id="example2" class="table table-striped table-bordered table_res dataTable "  style="font-size: 10px">
    <thead>
    <tr>
        <th rowspan="3" style="vertical-align: middle">Delegations</th>
        <th rowspan="3" style="vertical-align: middle">Département</th>
        <th style="font-weight: bold; font-size: 17px; text-align: center" colspan="<?php echo $nbre_decomptage ?>"> <?php echo  $_POST['camp'] ?></th>
    </tr>
    <tr>
    <th>Septembre</th>
    <th>Octobre</th>
    <th>Novembre</th>
    <th>Décembre</th>
    <th>Janvier</th>
    <th>Février</th>
    <th>Septembre</th>
    <th>Octobre</th>
    <th>Novembre</th>
    <th>Décembre</th>
    <th>Janvier</th>
    <th>Février</th>
    </tr>
    <tr style="font-weight: bold; color: #0e76a8">
    <th>A Juin</th>
    <th>A Juillet</th>
    <th>A Août</th>
    <th>A Septembre</th>
    <th>A Octobre</th>
    <th>A Novembre</th>
    <th>Juin</th>
    <th>Juillet</th>
    <th>Août</th>
    <th>Septembre</th>
    <th>Octobre</th>
    <th>Novembre</th>
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

            $list1 = somme_cpte_del('tb_comptage_cacao', $codedep, $_POST['camp'],7);
            $list2 = somme_cpte_del('tb_comptage_cacao', $codedep,  $_POST['camp'],8);
            $list3 = somme_cpte_del('tb_comptage_cacao', $codedep, $_POST['camp'],9);
            $list4 = somme_cpte_del('tb_comptage_cacao', $codedep,  $_POST['camp'],10);
            $list5 = somme_cpte_del('tb_comptage_cacao', $codedep, $_POST['camp'],1);
            $list6 = somme_cpte_del('tb_comptage_cacao', $codedep, $_POST['camp'],2);


            ?>
            <tr>
                <th><?php echo $rowdp['designation']; ?></th>

                <th><?php echo round($list1[0]['moya'],3) ?></th>
                <th><?php echo round($list2[0]['moya'],3) ?></th>
                <th><?php echo round($list3[0]['moya'],3)?></th>
                <th><?php echo round($list4[0]['moya'],3) ?></th>
                <th><?php echo round($list5[0]['moya'],3) ?></th>
                <th><?php echo round($list6[0]['moya'],3) ?></th>

                <th><?php echo round($list1[0]['moya']*$list1[0]['nb']) ?></th>
                <th><?php echo round($list2[0]['moya']*$list2[0]['nb']) ?></th>
                <th><?php echo round($list3[0]['moya']*$list3[0]['nb'])?></th>
                <th><?php echo round($list4[0]['moya']*$list4[0]['nb']) ?></th>
                <th><?php echo round($list5[0]['moya']*$list5[0]['nb']) ?></th>
                <th><?php echo round($list6[0]['moya']*$list6[0]['nb']) ?></th>

            </tr>

        <?php
            if (isset($list1)) $somx +=  $list1[0]['moya'];
            if (isset($list2)) $somx1 +=  $list2[0]['moya'];
            if (isset($list3))   $somx2 +=  $list3[0]['moya'];
            if (isset($list4))$somx3 +=  $list4[0]['moya'];
            if (isset($list5))$somx4 +=  $list5[0]['moya'];
            if (isset($list6))$somx5 +=  $list6[0]['moya'];

            if (isset($list1)) $somx_ +=  $list1[0]['moya']*$list1[0]['nb'];
            if (isset($list2)) $somx_1 +=  $list2[0]['moya']*$list2[0]['nb'];
            if (isset($list3))   $somx_2 +=  $list3[0]['moya']*$list3[0]['nb'];
            if (isset($list4))$somx_3 +=  $list4[0]['moya']*$list4[0]['nb'];
            if (isset($list5))$somx_4 +=  $list5[0]['moya']*$list5[0]['nb'];
            if (isset($list6))$somx_5 +=  $list6[0]['moya']*$list6[0]['nb'];

            $m++;
            $t++;$tt++;$tt_++; } ?>
<tr style="vertical-align: middle;background-color: darkred; color: white">
    <th> TOTAL <?php echo $rowdel['designation']; ?></th>

                <th><?php echo round($somx,3)  ; ?></th>
                <th><?php echo round($somx1,3) ; ?></th>
                <th><?php echo round($somx2,3) ; ?></th>
                <th><?php echo round($somx3,3) ; ?></th>
                <th><?php echo round($somx4,3) ; ?></th>
                <th><?php echo round($somx5,3) ; ?></th>

                <th><?php echo round($somx_)  ; ?></th>
                <th><?php echo round($somx_1) ; ?></th>
                <th><?php echo round($somx_2) ; ?></th>
                <th><?php echo round($somx_3) ; ?></th>
                <th><?php echo round($somx_4) ; ?></th>
                <th><?php echo round($somx_5) ; ?></th>




</tr>
<?php  } ?>

        </tbody>
        </table>
        </div>
        </div>
        </div>
        <?php } ?>