<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['c']) ) {

    $i = 0;
    $ncopeec=$_POST['c'];

    ?>

<table id="example2" class="table table-striped table-bordered table_res dataTable ">
    <thead>
    <tr>
        <th>#</th>
        <th>Nom et Prenoms</th>
        <th>Genre</th>
        <th>Contact</th>
        <th>Superficie</th>
        <th>Actions</th>

    </tr>
    </thead>

    <tbody>
   <?php

   $sqll = "SELECT *  from table_parcelle WHERE nom_coop='$ncopeec'";
   # Try query or error
   $rsl=$bdd->prepare($sqll);
   $rsl->execute();
   $m=1;
  while ($rowl = $rsl->fetch()){
   ?>
    <tr>
        <td><?php echo $m  ?></td>
        <td><?php echo $rowl['noms']  ?></td>
        <td><?php echo $rowl['sexe']  ?></td>
        <td><?php echo $rowl['contact']  ?></td>
        <td><?php echo $rowl['sup_ha']  ?></td>
        <td>
            <a href="#"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
            &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
        </td>
    </tr>
    <?php $m++ ; } ?>
    </tbody>
</table>

<?php }