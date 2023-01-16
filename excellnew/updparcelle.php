<?php
/*ini_set('memory_limit', '1G');
set_time_limit(1000);*/
include '../connexion/connectpg.php';
include '../connexion/function.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;

$inputFileType = 'Xlsx';
$inputFileName = 'gps6.xlsx';

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





                $rsppp = $bdd->prepare('select * from tb_parcelle where code_parcelle= :d ');
        $rsppp->execute(array('d' => $t[0] ));
                $nb = $rsppp->rowCount();

                if ($nb==1 ){
                    $lo1 = ltrim($t[2]);
                    $lo = rtrim($lo1);
                    $la1 = ltrim($t[1]);
                    $la = rtrim($la1);
                    // update
                    $rsql = $bdd->prepare('UPDATE tb_parcelle  SET  long = :lo, lat = :la WHERE code_parcelle = :c');
                    $rsql->execute(array('lo' =>$t[2] ,'la' => $t[1],'c' => $t[0]));
                    var_dump(array('lo' => $t[2],'la' => $t[1],'c' => $t[0]));

                }else{


                }


                $i++;
            }


}
