<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['code']) ) {

    $i = 0;
    $code=$_POST['code'];



     $sqll = "SELECT *,v.designation as vil  from tb_village v ,tb_sousprefecture sp WHERE sp.code_sous_prefecture=v.sous_prefecture_code AND sp.departement_code= '$code'";
    # Try query or error
    $rsl=$bdd->prepare($sqll);
    $rsl->execute();
    $m=1;
    ?>
    <option selected disabled>Choisir Village</option>
    <?php
    while ($rowl = $rsl->fetch()){
    ?>
        <option value="<?php echo $rowl['code_village'] ?>"><?php echo $rowl['designation'].' / '.$rowl['vil'].'' ?></option>

<?php } }