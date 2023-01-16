<?php // Connection à la base de données
include '../connexion/connectpg.php';
include '../connexion/function.php';


# However the User's Query will be passed to the DB:
 $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS g  from fc_4326_1 ';
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

    $feature = array(
        'idf' => $row['gid'],
        'type' => 'Feature',
        'geometry' => json_decode($row['g'], true),
      /*  'geometry' => array(
            'type' => 'Point',
            'coordinates' => [$row['cord_y'],$row['cord_x']],
        ),*/
        # Pass other attribute columns here
        'properties' => array(
            'libf' =>  $row['nom'],
            'supf' =>  $row['aire']
        )
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}
header('Content-type: application/json');
$datahs = json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;
echo $datahs;
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