<?php
include '../connexion/connectpg.php';
include '../connexion/function.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;

$inputFileType = 'Xlsx';
$inputFileName = 'sp.xlsx';

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
        $rsc = $bdd->prepare('select * from tb_departement where designation= :d ');
        $rsc->execute(array('d' => $t[0] ));
        $nbc = $rsc->rowCount();
        echo $nbc;
        echo " <br>";

            if ($nbc==1){
                $row = $rsc->fetch();
               // echo $row['code_delegation']." <br>";
                //echo $i."---".$t[0].",".$t[1]." <br>";
                $nbrep = get_id($row['code_departement']);
                $rsmax = $bdd->prepare('select * from tb_sousprefecture  ');
                $rsmax->execute();
                $nbmax = $rsmax->rowCount();
               echo  $nbrep2 = $nbmax+1;
                $nam = addslashes($t[1]);
                echo $codedep = $row['code_departement'];
                echo " <br>";

                 $codesp = "SP". numauto($nbrep2,1);
                $rs = $bdd->prepare('select * from tb_sousprefecture where code_sous_prefecture= :d ');
                $rs->execute(array('d' => $codesp ));
                $nb = $rs->rowCount();

                if ($nb==0){
                   echo  $query2 = "INSERT INTO tb_sousprefecture(code_sous_prefecture,designation,datecrea,departement_code) VALUES('$codesp','$nam', '$date','$codedep')";
                    //$result2 = $bdd->exec($query2);
                    // on insere dans la BD

                }





                $i++;
            }

    }

}

function get_id($code){
    $bdd="";
    include '../connexion/connectpg.php';

    $rsd = $bdd->prepare('select * from tb_sousprefecture where departement_code = :d ');
    $rsd->execute(array('d' => $code ));
    $nbd = $rsd->rowCount();
    return $nbd;
}