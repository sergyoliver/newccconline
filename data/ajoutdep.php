<?php // Connection à la base de données
//error_reporting(0);
require ('../connexion/connectpg.php');
require('../connexion/function.php');

if (isset($_POST['dp']) ) {

    $i = 0;
    $dp = strtoupper($_POST['dp']);
    $del=$_POST['dl'];
    $sqldp = $bdd->prepare('select * from tb_departement where delegation_code= :d   and designation= :dp', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sqldp->execute(array('d' => $del, 'dp' => $dp));
    $nbdp = $sqldp->rowCount();
    if ($nbdp==0){
        $sqldp1 = $bdd->prepare('select * from tb_departement ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sqldp1->execute();
        $nbdp1 = $sqldp1->rowCount();
        $codedep = 'DP'.($nbdp1+1);

        $rs2 = $bdd->prepare('INSERT INTO tb_departement(code_departement, designation, delegation_code) VALUES(:code_departement, :designation, :delegation_code)');
        $rs2->execute(array('code_departement' => $codedep,'designation' => $dp, 'delegation_code' => $del));

    }else{
        echo '<h3 style="color: red">Ce departement :  '.$dp.' existe déjà !!! </h3>';
    }

    }
?>

<table id="example2"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code </th>
                                    <th>Désignation</th>
                                    <th>Nbre sous préfecture</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare('select * from tb_departement where delegation_code= :d  ORDER BY code_departement  desc');
                                $rsg->execute(array('d' => $del));
                                while($rowg = $rsg->fetch()) {
                                    $codedep = $rowg['code_departement'];
                                    $rsppp = $bdd->prepare('select * from tb_sousprefecture where departement_code= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                    $rsppp->execute(array('d' => $codedep  ));
                                    $nb = $rsppp->rowCount();

                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rowg['code_departement']; ?></td>
                                        <td><?php echo $rowg['designation']; ?></td>
                                        <td><a href="?page=listesousprefecture&cd=<?php echo $rowg['code_departement']; ?>"><?php echo number_format($nb); ?></a></td>

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
