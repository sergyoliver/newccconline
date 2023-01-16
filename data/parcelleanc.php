<?php // Connection à la base de données
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../connexion/connectpg.php';
include '../connexion/function.php';
# However the User's Query will be passed to the DB:
 $sql = "SELECT *  from tb_parcelle WHERE   longitude <>''  ";
# Try query or error
$rs=$bdd->prepare($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}
$rs->execute();


# Build GeoJSON feature collection array
$geojson = array(
    'type'      => 'FeatureCollection',
    'features'  => array()
);
# Loop through rows to build feature arrays
while($row = $rs->fetch()) {
     $codedep = $row['departement_code'];
     $codeprod = $row['code_prod'];
   //  echo "SELECT *  from tb_departement WHERE code_departement='$codedep'";
     //echo '<br>';
   $rsdep =$bdd->prepare("SELECT *  from tb_departement WHERE code_departement='$codedep'");
    $rsdep->execute();
    $rowdp = $rsdep->fetch();


    $rsprod =$bdd->prepare("SELECT *  from tb_producteur WHERE code_producteur='$codeprod'");
    $rsprod->execute();
    $rowprod = $rsprod->fetch();

    $feature = array(
        'idf' => $row['id'],
        'type' => 'Feature',
       // 'geometry' => json_decode($row['g'], true),
         'geometry' => array(
              'type' => 'Point',
              'coordinates' => [$row['longitude'], $row['latitude']],
          ),/* */
        # Pass other attribute columns here
        'properties' => array(
            'codep' =>  $row['code_parcelle'],
            'nomp' =>  $row['nom_parcelle'],
            'variete' =>  $row['variete'],
            'superficie' =>  $row['superficie'],
            'nom_prod' =>  $rowprod['nom'],
           'dep' =>  $rowdp['designation'],
            'typep' =>  $row['type_plantation']
        )
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
    $datahs = json_encode($geojson);
    $conn = NULL;
    echo $datahs;

}
//header('Content-type: application/json');
//var_dump($t);
//$conn = NULL;
////echo $data3;
////$geo = json_encode($formation); /*encodage de l'array $formation*/
//$formations = fopen('hbtwgs.geojson', 'rw+');  /* ouverture du fichier geojson*/
//
//
//fputs($formations, $data3); /* ecriture des points récupérés depuis la base de données*/
//
//
//fclose($formations); /* fermeture du fichier geojson*/
?>