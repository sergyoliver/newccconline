<?php
include "../connexion/connectpg.php";
include "../connexion/function.php";


require '../excellnew/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;
if (isset($_POST['export'])  ) {
    $i = 0;
    $ncopeec = $_POST['couche'];
    if (!empty($_POST['couche']) && $_POST['km'] == 1){

        $sql = "SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,fc_4326_1 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom)";
        # Try query or error
        $rsl = $bdd->prepare($sql);
        $rsl->execute();

        $titre ='Liste des parcelles dans le forêts classées ';
    }

    if (!empty($_POST['couche']) && $_POST['km'] == 2){

        $sql = "SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,km2_4326 where nom_coop='$ncopeec' and  ST_Intersects(table_parcelle.geom, km2_4326.geom)";
        # Try query or error
        $rsl = $bdd->prepare($sql);
        $rsl->execute();
       // $nbretotp = $rsl->rowCount();


        $titre ='Liste des parcelles Distantes de 2Km le forêts classées ';
    }


    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', $titre);
    $sheet->setCellValue('A2', 'Nom et Prenoms')
        ->setCellValue('B2', 'Genre')
        ->setCellValue('C2', 'Contact')
        ->setCellValue('D2', 'Superficie')
        ->setCellValue('E2', 'Lat')
        ->setCellValue('F2', 'Long');

    // var_dump($_POST);


    $i=1;

    $rowCount = 3;
    while($row = $rsl->fetch()) {



            $sheet->setCellValue('A'.$rowCount,mb_strtoupper($row['noms'], 'UTF-8'))
                ->setCellValue('B'.$rowCount,mb_strtoupper($row['sexe'], 'UTF-8'))
                ->setCellValue('C'.$rowCount, mb_strtoupper($row['contact'], 'UTF-8'))
                ->setCellValue('D'.$rowCount, $row['sup_ha'])
                ->setCellValue('E'.$rowCount, $row['lt'])
                ->setCellValue('F'.$rowCount, $row['lg']);
            $rowCount++;

    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
    header('Content-Disposition: attachment;filename="export.xlsx"');

//create IOFactory object
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
    $writer->save('php://output');
}