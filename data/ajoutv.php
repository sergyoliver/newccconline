<?php // Connection à la base de données
//error_reporting(0);
require ('../connexion/connectpg.php');
require('../connexion/function.php');

if (isset($_POST['dp']  ) && isset($_POST['sp'])) {

    $i = 0;
    $sp = strtoupper($_POST['sp']);
    $dp=$_POST['dp'];
    $sqldp = $bdd->prepare('select * from tb_sousprefecture where departement_code= :d   and designation= :dsp', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sqldp->execute(array('d' => $dp, 'dsp' => $sp));
    $nbdp = $sqldp->rowCount();
    if ($nbdp==0){
        $sqldp2 = $bdd->prepare('select MAX(id) as id from tb_sousprefecture');
        $sqldp2->execute();
        //$sqldp1 = $bdd->prepare('select * from tb_sousprefecture ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rowsp = $sqldp2->fetch();
        $idmax =  $rowsp['id'];
        $sqldp3 = $bdd->prepare('select * from tb_sousprefecture WHERE id = :d');
        $sqldp3->execute(array('d'=>$idmax));
        //$sqldp1 = $bdd->prepare('select * from tb_sousprefecture ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rowsp2 = $sqldp3->fetch();

        $rest = substr($rowsp2['code_sous_prefecture'], 2, 4);
         $codesp = 'SP'.($rest+1);

        $rs2 = $bdd->prepare('INSERT INTO tb_sousprefecture(code_sous_prefecture, designation, departement_code,datecrea) VALUES(:code_sous_prefecture, :designation, :departement_code, :datecrea)');
        $rs2->execute(array('code_sous_prefecture' => $codesp,'designation' => $sp, 'departement_code' => $dp, 'datecrea' => gmdate('Y:m:d H:i:s')));

    }else{
        echo '<h3 style="color: red">Cete sous prefecture :  '.$sp.' existe déjà !!! </h3>';
    }

    }
?>

<table id="example2"  class="table2excel display table table-stripped table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Code </th>
        <th>Désignation</th>
        <th>Nbre village</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $i=1;
    $rsg = $bdd->prepare('select * from tb_sousprefecture where departement_code= :d ');
    $rsg->execute(array('d' => $dp));
    while($rowg = $rsg->fetch()) {
        $codes = $rowg['code_sous_prefecture'];
        $rsppp = $bdd->prepare('select * from tb_village where sous_prefecture_code= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsppp->execute(array('d' => $codes  ));
        $nb = $rsppp->rowCount();

        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rowg['code_sous_prefecture']; ?></td>
            <td><?php echo $rowg['designation']; ?></td>
            <td><a href="?page=listevillage&cd=<?php echo $rowg['code_sous_prefecture']; ?>"><?php echo number_format($nb); ?></a></td>

            <td>
                <a href="?page=modifdepartement&id=<?php echo $rowg['id']; ?>" class="todoedit">
                    <span class="fa fa-pencil"></span>
                </a>
                <span class="dividor">|</span>
                <a href="#" class="tododelete redcolor">
                    <span class="fa fa-trash"></span>
                </a>

            </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>


