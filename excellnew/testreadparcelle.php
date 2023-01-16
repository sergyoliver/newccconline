<?php
ini_set('memory_limit', '1G');
set_time_limit(1000);
include '../connexion/connectpg.php';
include '../connexion/function.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;

$inputFileType = 'Xlsx';
$inputFileName = 'parcelle.xlsx';

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);

$sheetData = $spreadsheet->getActiveSheet()->toArray();

$i=1;
 $date = gmdate('Y-m-d H:i:s');
unset($sheetData[0]);
function convert_date_excel($date){
    $real_date = ($date-25569)*86400;
    $real_date = date("d-m-Y", $real_date);
    return $real_date;
}
foreach ($sheetData as $t) {
    // process element here;
// access column by index
    if (!empty($t[3])){

    $rsmax = $bdd->prepare('select * from tb_parcelle  ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $rsmax->execute();
    $nbmax = $rsmax->rowCount();
      $nbrep2 = $nbmax+1;
    $village = addslashes($t[1]);
    /// recherche code village
        $rsv = $bdd->prepare('select * from tb_village where designation = :d ');
        $rsv->execute(array('d' => $t[1] ));
        $rowv = $rsv->fetch();
        $codevillage = $rowv['code_village'];
        $sp = $rowv['sous_prefecture_code'];

        $rssp = $bdd->prepare('select * from tb_sousprefecture where code_sous_prefecture = :d ');
        $rssp->execute(array('d' =>$sp ));
        $rowsp = $rssp->fetch();

        $codedp = $rowsp['departement_code'];

        $rsdp = $bdd->prepare('select * from tb_departement where designation = :d ');
        $rsdp->execute(array('d' =>$t[0] ));
        $rowdp = $rsdp->fetch();
        $codedel = $rowdp['delegation_code'];
       // echo '<br />';
        $typep = $t[2];
        // '<br />';
          $nomp = $t[3];
        //echo '<br />';
         $codep = $t[4];
    // echo '<br />';
     $nomprod = $t[5];
    $rsprod = $bdd->prepare('select * from tb_producteur where nom = :d ');
    $rsprod->execute(array('d' =>$nomprod ));
    $rowprod = $rsprod->fetch();
    $codeprod = $rowprod['code_producteur'];

     $ancrea = $t[6];
     $variete = $t[7];
     $obs = $t[8];
    $modea= $t[9];
    $sup = $t[10];
    $prodtot = $t[11];
        if (!empty($t[12])){
        $datecrea = convert_date_excel($t[12]);
    }else{
            $datecrea = "";
    }
    $suppar = $t[13];
    $obsvariete = $t[14];
   // echo " <br>";


                $rsppp = $bdd->prepare('select * from tb_parcelle where code_parcelle= :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $rsppp->execute(array('d' => $codep ));
                $nb = $rsppp->rowCount();

                if ($nb==0 && !empty($codeprod)&& !empty($codedp)){
                     $query2 = "INSERT INTO tb_parcelle(code_parcelle,delegation_code,code_sous_prefecture,village_code,
type_plantation,departement_code,nom_parcelle,mode_aquisition,date_creation,code_prod,variete,superficie,production_annuelle,
annnee_creation,observation_variete,parcelleeliminer) 
                          VALUES('$codep','$codedel', '$sp','$codevillage','$typep','$codedp','$nomp','$modea','$datecrea',
                          '$codeprod','$variete','$sup','$prodtot','$ancrea','$obsvariete','$suppar')";
               //$result2 = $bdd->exec($query2);
                    // on insere dans la BD

                }else{
                    echo $codeprod." ". $codep." ".$rowdp['designation']." ".$codedel." Code village : ". $t[1]." sp : ".$sp;
                    echo '<br>';

                   echo  $query3 = "INSERT INTO parcelle(code_parcelle,delegation_code,code_sous_prefecture,village_code,
type_plantation,departement_code,nom_parcelle,mode_aquisition,date_creation,code_prod,variete,superficie,production_annuelle,
annnee_creation,observation_variete,parcelleeliminer) 
                          VALUES('$codep','$codedel', '$sp','$codevillage','$typep','$codedp','$nomp','$modea','$datecrea',
                          '$codeprod','$variete','$sup','$prodtot','$ancrea','$obsvariete','$suppar')";

                }





                $i++;
            }


}

function get_id($code){
    $bdd="";
    include '../connexion/connectpg.php';

    $rsd = $bdd->prepare('select * from tb_village where code_village = :d ', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $rsd->execute(array('d' => $code ));
    $nbd = $rsd->rowCount();
    return $nbd;
}