<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['p']) ) {

    $i = 0;
    $ncopeec=$_POST['p'];

    ?>

<table id="example1" class="table table-striped table-bordered table_res dataTable ">
    <thead>
    <tr>
        <th>#</th>
        <th>Sous prefecture</th>
        <th>Village</th>
        <th>Code</th>
        <th>designation</th>
        <th>Variété</th>
        <th>Date creation</th>
        <th>Superficie(ha)</th>
        <th>Production Annuelle </th>
        <th>Actions</th>

    </tr>
    </thead>

    <tbody>
   <?php

   $sqll = "SELECT *  from tb_parcelle WHERE code_prod='$ncopeec'";
   # Try query or error
   $rsl=$bdd->prepare($sqll);
   $rsl->execute();
   $m=1;
  while ($rowl = $rsl->fetch()){
      $codev = $rowl['code_village'];
      $rsv = $bdd->prepare('select * from tb_village where code_village= :d ');
      $rsv->execute(array('d' => $codev ));
      $rowv=  $rsv->fetch();
      $codesp = $rowl['code_sous_prefecture'];
      $rssp = $bdd->prepare('select * from tb_village where code_village= :d ');
      $rssp->execute(array('d' => $codev  ));
      $rowsp=  $rssp->fetch();

   ?>
    <tr>
        <td><?php echo $m  ?></td>
        <td><?php echo $rowsp['designation']  ?></td>
        <td><?php echo $rowv['designation']  ?></td>
        <td><?php echo $rowl['code_parcelle']  ?></td>
        <td><?php echo $rowl['nom_parcelle']  ?></td>
        <td><?php echo $rowl['variete']  ?></td>
        <td><?php echo $rowl['date_creation']  ?></td>
        <td><?php echo $rowl['supparcelle']  ?></td>
        <td><?php echo $rowl['productionannuel']  ?></td>
        <td>
            <a href="#"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
            &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
        </td>
    </tr>
    <?php $m++ ; } ?>
    </tbody>
</table>

<?php }