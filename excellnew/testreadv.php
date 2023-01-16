<?php
include '../connexion/connectpg.php';
include '../connexion/function.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;

$inputFileType = 'Xlsx';
$inputFileName = 'village.xlsx';

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

foreach ($sheetData as $t) {
    // process element here;
// access column by index
    if (!empty($t[0]) && !empty($t[1])){

        // oon verifie s'il existe dans la table copnnexion
        $rsc = $bdd->prepare('select * from tb_sousprefecture where designation= :d ');
        $rsc->execute(array('d' => $t[0] ));
        $nbc = $rsc->rowCount();
      //  echo $nbc;


            if ($nbc==1){
                $row = $rsc->fetch();
               // echo $row['code_delegation']." <br>";
                //echo $i."---".$t[0].",".$t[1]." <br>";
                $nbrep = get_id($row['code_sous_prefecture']);
                $rsmax = $bdd->prepare('select * from tb_village  ');
                $rsmax->execute();
                $nbmax = $rsmax->rowCount();
                  $nbrep2 = $nbmax+1;
                $nam = $t[1];
                 $codesp = $row['code_sous_prefecture'];
               // echo " <br>";

                 $codevi = "VI". numauto($nbrep2,3);
                $rs = $bdd->prepare('select * from tb_village where sous_prefecture_code= :d AND designation = :ds');
                $rs->execute(array('d' => $codesp, 'ds' => $nam ));
                $nb = $rs->rowCount();
               // echo $nb;
                if ($nb==0){
                      $query2 = "INSERT INTO tb_village(code_village,designation,datecrea,sous_prefecture_code) VALUES('$codevi','$nam', '$date','$codesp')";
                   // $result2 = $bdd->exec($query2);
                    // on insere dans la BD
                    echo  $codesp = $row['code_sous_prefecture']." - ".$nam;
                    echo " <br>";
                }else{

                   // echo  $codesp = $row['code_sous_prefecture']." - ".$nam;
                    echo " <br>";
                }





                $i++;
            }else{
                echo 'je ne voi pas';
                echo " <br>";
               //echo  $t[0];
            }

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