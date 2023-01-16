<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['c']) && isset($_POST['k']) ) {

    $i = 0;
    $ncopeec = $_POST['c'];
    if (!empty($_POST['c']) && $_POST['k'] == 1){

        $sql = "SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,fc_4326_1 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom)";
        # Try query or error
        $rsl = $bdd->prepare($sql);
        $rsl->execute();
        $nbretotp = $rsl->rowCount();

        $rssup = $bdd->prepare("select sum(sup_ha) as sup from table_parcelle,fc_4326_1 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom)");
        $rssup->execute();
        $rowsup = $rssup->fetch();

        // nbre de parcelles
        // nbre de parcelles
        $rsph = $bdd->prepare("select noms from table_parcelle,fc_4326_1 WHERE  sexe='M' and  nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom) GROUP BY noms ");
        $rsph->execute();
        $nbph = $rsph->rowCount();

        // nbre de parcelles
        $rspf = $bdd->prepare("select noms from table_parcelle,fc_4326_1 WHERE  sexe='F' and  nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom) GROUP BY noms ");
        $rspf->execute();
        $nbpf = $rspf->rowCount();
        $m = 1;
        $titre ='<h4>Liste des parcelles dans le forêts classées </h4>';
    }

    if (!empty($_POST['c']) && $_POST['k'] == 2){

        $sql = "SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,km2_4326 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, km2_4326.geom)";
        # Try query or error
        $rsl = $bdd->prepare($sql);
        $rsl->execute();
        $nbretotp = $rsl->rowCount();

        $rssup = $bdd->prepare("select sum(sup_ha) as sup from table_parcelle,km2_4326 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, km2_4326.geom)");
        $rssup->execute();
        $rowsup = $rssup->fetch();

        // nbre de parcelles
        // nbre de parcelles
        $rsph = $bdd->prepare("select noms from table_parcelle,km2_4326 WHERE  sexe='M' and  nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, km2_4326.geom) GROUP BY noms ");
        $rsph->execute();
        $nbph = $rsph->rowCount();

        // nbre de parcelles
        $rspf = $bdd->prepare("select noms from table_parcelle,km2_4326 WHERE  sexe='F' and  nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, km2_4326.geom) GROUP BY noms ");
        $rspf->execute();
        $nbpf = $rspf->rowCount();
        $m = 1;
        $titre ='<h4>Liste des parcelles Distantes de 2Km le forêts classées </h4>';
    }

    ?>

    <table class="table table-striped table-bordered table_res dataTable ">
        <tr>
            <td colspan="4" style="text-align: center"><?php echo   $titre; ?></td>
        </tr>
        <tr style="background-color: darkred; color: white">
            <td>Nb parcelle</td>
            <td>Nb homme</td>
            <td>Nb femme</td>
            <td>Superficie total(ha)</td>
        </tr>
        <tr style="font-weight: bold; font-size: 15px">
            <td><?php echo number_format($nbretotp); ?></td>
            <td><?php echo number_format($nbph); ?></td>
            <td><?php echo number_format($nbpf); ?></td>
            <td><?php echo number_format($rowsup['sup']); ?></td>
        </tr>
    </table>


<table id="example2" class="table table-striped table-bordered table_res dataTable ">
    <thead>
    <tr style="text-align: center">
        <td colspan="5"> <button class="btn btn-success"   name="export">
                <i class="fa fa-file-excel-o"></i>
                Telecharger
            </button></td>
    </tr>
    <tr>
        <th>#</th>
        <th>Nom et Prenoms</th>
        <th>Genre</th>
        <th>Contact</th>
        <th>Superficie(ha)</th>
        <th>Actions</th>

    </tr>
    </thead>

    <tbody>
   <?php




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