<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['code']) ) {

    $i = 0;
    $code=$_POST['code'];

    $sqlsp = $bdd->prepare("SELECT *  from tb_departement WHERE code_departement='$code'");
    # Try query or error

    $sqlsp->execute();
    $rowsp = $sqlsp->fetch();
    $nomsp = $rowsp['designation'];

     $rest = substr($nomsp, 0, 3);
     $codeapp = 'K'.$rest;

    $sqll = "SELECT *  from tb_parcelle WHERE code_parcelle like '$codeapp%'";
    # Try query or error
    $rsl=$bdd->prepare($sqll);
    $rsl->execute();
    $m=1;
    ?>
    <option selected disabled>Choisir Parcelle</option>
    <?php
    while ($rowl = $rsl->fetch()){
    ?>

        <option value="<?php echo $rowl['code_parcelle'] ?>"><?php echo $rowl['nom_parcelle'].' ('.$rowl['code_parcelle'].')' ?></option>


<?php } }