<?php
include '../connexion/connectpg.php';
include '../connexion/function.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;

$inputFileType = 'Xlsx';
$inputFileName = 'producteur.xlsx';

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
    if (!empty($t[0])){



                $rsmax = $bdd->prepare('select * from tb_producteur  ');
                $rsmax->execute();
                $nbmax = $rsmax->rowCount();
               echo  $nbrep2 = $nbmax+1;
                $nom = addslashes($t[0]);
                 $nat = $t[1];
                 $sexe = $t[2];
                 $taille = $t[3];
                 $pointure = $t[4];
                 $natp = $t[5];
                 $nump = $t[6];
                 $daten = convert_date_excel($t[7]);
                 $lieun = $t[8];
                 $cont = $t[9];
                 $cell = $t[10];
                 $bp = $t[11];
                echo " <br>";

              echo   $codevi = "PROD". numauto($nbrep2,3);
                $rs = $bdd->prepare('select * from tb_producteur where nom= :d ');
                $rs->execute(array('d' => $nom ));
                $nb = $rs->rowCount();
                echo $nb;
                if ($nb==0){
                   echo  $query2 = "INSERT INTO tb_producteur(code_producteur,nom,date_de_naissance,lieu_de_naissance,genre,numero_piece,contact,adresse_postale,taille,pointure,type_piece,nationalite,cel) 
                          VALUES('$codevi',$nom, '$daten','$lieun','$sexe','$nump','$cont','$bp','$taille','$pointure','$natp','$nat','$cell')";
                    $result2 = $bdd->exec($query2);
                    // on insere dans la BD

                }





                $i++;
            }


}

function get_id($code){
    $bdd="";
    include '../connexion/connectpg.php';

    $rsd = $bdd->prepare('select * from tb_village where code_village = :d ');
    $rsd->execute(array('d' => $code ));
    $nbd = $rsd->rowCount();
    return $nbd;
}