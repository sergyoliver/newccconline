<?php // Connection à la base de données
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../connexion/connectpg.php';
include '../connexion/function.php';


# However the User's Query will be passed to the DB:
$sql = "SELECT *  FROM tb_parcelle WHERE   longitude <>'' and latitude<>'' ";
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
$i=0;
while($row = $rs->fetch()) {
   // echo $row['longitude'];
    $test[$i] = array(
        'id' => $row['id'],
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => [$row['longitude'],$row['latitude']],
        ),
        # Pass other attribute columns here
        'properties' => array(
            'codep' =>  $row['code_parcelle'],
            'nomp' =>  $row['nom_parcelle'],
            'variete' =>  $row['variete'],
            'superficie' =>  $row['superficie'],
         //   'nom_prod' =>  $rowprod['nom'],
            //   'dep' =>  $rowdp['designation'],
            'type' =>  $row['type_plantation']
        )

    );

    # Add feature arrays to feature collection array
    $geojson['features']= $test;
    $i++;
    $datahs = json_encode($geojson);

    echo $datahs;
}


//header('Content-type: application/json');


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