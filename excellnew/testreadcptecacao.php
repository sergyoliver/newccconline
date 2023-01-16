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
$inputFileName = 'cacaoalltest.xlsx';

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
    if (!empty($t[6]) && !empty($t[7])){


    /// recherche code village
        $rsv = $bdd->prepare('select * from tb_pied where numero_pied = :d ');
        $rsv->execute(array('d' => $t[7] ));
        $rowv = $rsv->fetch();
        $codepied = $rowv['code_pied'];
        $codepar = $t[6];
        /// extraire Délegation
        $tab_gdel = str_split($t[0],3);
        if ($tab_gdel[0]=='ABI'){
            $code_delegation='ABJ';
        }else{
            $code_delegation =$tab_gdel[0];
        }


        $tab_code = str_split($codepar);
        $code_del2 =$tab_code[1].$tab_code[2].$tab_code[3];
        if ($code_del2=='GRL'){
            $code_del='GRA';
        }elseif ($code_del2=='TOM'){
            $code_del='TOU';
        }else{
            $code_del= $code_del2;
        }

//echo "SELECT code_departement,delegation_code  from tb_departement where designation like '$code_del%' and delegation_code='$code_delegation'";

        $rsdep = $bdd->prepare("SELECT code_departement,delegation_code  from tb_departement where designation like '$code_del%' and delegation_code='$code_delegation'");
        $rsdep->execute();
        $rowdep = $rsdep->fetch();
        $code_dept = $rowdep['code_departement'];
        $code_del1 = $rowdep['delegation_code'];


        $rssp = $bdd->prepare('select * from tb_parcelle where code_parcelle = :d ');
        $rssp->execute(array('d' =>$codepar ));
        $rowsp = $rssp->fetch();
        $codevillage = $rowsp['village_code'];

        $passage  = "PASSAGE ".$t[4];
        $rspassage = $bdd->prepare("select * from tb_passage where libelle = :d  and type_periode = :tp AND  type_pied ='K' ");
        $rspassage->execute(array('d' =>$passage,'tp' =>$t[3] ));
        $rowpass = $rspassage->fetch();
        $idpassage = $rowpass['id'];



        //$ane_camp ="2021-2022";
        $ane_camp =$t[2];
        $ane ="2022";

        $fA = $t[8];
        $fB = $t[9];
        $fC = $t[10];
        $fD = $t[11];
        $pA = $t[12];
        $pB = $t[13];
        $peseF = $t[14];
        $fe = $t[15];
        $flo = $t[16];
        $noue = $t[17];

        if ($t[19]==""){
            $supp = 0;
        }else{
            $supp = 1;
        }
        $raison= addslashes($t[18]) ;
        $uid= $t[20] ;




                $rsppp = $bdd->prepare('select * from tb_comptage_cacao where uuid = :u ');
        $rsppp->execute(array('u' => $t[20] ));
                $nb = $rsppp->rowCount();
                echo "<b>".$nb."</b>";
                echo "<br />";
                if ($nb==1){
                   echo  $query2 = "INSERT INTO tb_comptage_cacao(idpassage,fruit_a,fruit_b,fruit_c,
fruit_d,pertes_a,pertes_b,Fe,Flo,pese_f,Noue,supp,pied_code,parcelle_code,raison_supp,an_campagne,village_code,uuid,code_del,code_dep) 
                          VALUES('$idpassage','$fA', '$fB','$fC','$fD','$pA','$pB','$fe','$flo',
                          '$peseF','$noue','$supp','$codepied','$codepar','$raison','$ane_camp','$codevillage','$uid','$code_del1','$code_dept')";
                  //$result2 = $bdd->exec($query2);
                    // on insere dans la BD

                }else{
                    echo  "passage : ".$t[4];
                    echo "<br />";
                    echo  "Pied : ".$codepied;
                    echo "<br />";
                    echo  "code parcelle  : ".$codepar;
                    echo "<br />";
                    $query23 = "INSERT INTO tb_comptage_cacao_non(idpassage,fruit_a,fruit_b,fruit_c,
fruit_d,pertes_a,pertes_b,Fe,Flo,pese_f,Noue,supp,pied_code,parcelle_code,raison_supp,an_campagne,village_code,uuid,code_del,code_dep) 
                          VALUES('$idpassage','$fA', '$fB','$fC','$fD','$pA','$pB','$fe','$flo',
                          '$peseF','$noue','$supp','$codepied','$codepar','$raison','$ane_camp','$codevillage','$uid','$code_del1','$code_dept')";
                    $result23 = $bdd->exec($query23);

                }





                $i++;
            }


}

