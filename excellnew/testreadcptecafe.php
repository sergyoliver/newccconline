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
$inputFileName = 'cptecafe2020.xlsx';

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
    if (!empty($t[6])){
        echo ltrim($t[6]);
        echo '<br />';
        $test =  str_replace(' ', '', $t[6]);

        echo '<br />';
        echo  $rest = substr($test, 0, 2);



       // $tabcafe = explode('&nbsp;&nbsp;',ltrim($t[6]) );
      //  var_dump($tabcafe);

            /// recherche code village
                $rsv = $bdd->prepare("select * from pied where numero_pied = :d and type_pied='C'");
                $rsv->execute(array('d' => $rest ));
                $rowv = $rsv->fetch();
                 $codepied = $rowv['code_pied'];
               $codepar = $t[5];




                $rssp = $bdd->prepare('select * from parcelle where code_parcelle = :d ');
                $rssp->execute(array('d' =>$codepar ));
                $rowsp = $rssp->fetch();
                $codevillage = $rowsp['village_code'];

                $passage  = "PASSAGE ".$t[3];
                $rspassage = $bdd->prepare("select * from tb_passage where libelle = :d AND  type_pied ='C' ");
                $rspassage->execute(array('d' =>$passage ));
                $rowpass = $rspassage->fetch();
                $idpassage = $rowpass['id'];


                $ane_camp ="2019-2020";
               // $ane ="2020";

                $grappe = $t[7];
                $fruit = $t[8];

                $peseF = $t[9];
                $fe = $t[10];
                $flo = $t[11];
                $noue = $t[12];
                $obs = $t[13];

                if ($t[14]=="x"){
                    $supp = 1;
                }else{
                    $supp = 0;
                }





                        $rsppp = $bdd->prepare('select * from tb_comptage_cafe where parcelle_code= :d and pied_code = :p and idpassage = :idp and an_campagne = :an ');                $rsppp->execute(array('d' => $codepar, 'p' => $codepied , 'idp' => $idpassage , 'an' => $ane_camp ));
                        $nb = $rsppp->rowCount();
                        echo "<b>".$nb."</b>";
                        echo "<br />";
                        if ($nb==0 and  !empty($codevillage)){
                           echo  $query2 = "INSERT INTO tb_comptage_cafe(idpassage,grappe,fruit,Fe,
        Flo,peseF,Noue,observation,pied_code,parcelle_code,village_code,an_campagne)
                                  VALUES('$idpassage','$grappe', '$fruit','$fe','$flo','$peseF','$noue',
                                  '$obs','$codepied','$codepar','$codevillage','$ane_camp')";
                          $result2 = $bdd->exec($query2);
                            // on insere dans la BD

                        }else{
                            echo  "passage : ".$t[3];
                            echo "<br />";
                            echo  "Pied : ".$codepied;
                            echo "<br />";
                            echo  "code parcelle  : ".$codepar;
                            echo "<br />";

                        }

        $i++;/**/
            }


}

function get_id($code){
    $bdd="";
    include '../connexion/connectpg.php';

    $rsd = $bdd->prepare('select * from tbvillage where code_village = :d ');
    $rsd->execute(array('d' => $code ));
    $nbd = $rsd->rowCount();
    return $nbd;
}