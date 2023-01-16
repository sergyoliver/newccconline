<?php // Connection à la base de données
include '../connexion/connectpg.php';
if (isset($_GET['id'])) {
$id = $_GET['id'];
# However the User's Query will be passed to the DB:
    $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((geom),4326),6) AS geojson from parcellepro WHERE idp = :p';
# Try query or error
    $rs = $bdd->prepare($sql);
    if (!$rs) {
        echo 'An SQL error occured.\n';
        exit;
    }
    $rs->execute(array("p" => $id));

# Build GeoJSON feature collection array
    $geojson = array(
        'type' => 'FeatureCollection',
        'features' => array()
    );
# Loop through rows to build feature arrays
    while ($row = $rs->fetch()) {
        $feature = array(
            'id' => $row['idp'],
            'type' => 'Feature',
            'geometry' => json_decode($row['geojson'], true),
            # Pass other attribute columns here

        );
        # Add feature arrays to feature collection array
        array_push($geojson['features'], $feature);
    }
    header('Content-type: application/json');
    $datap = json_encode($geojson, JSON_NUMERIC_CHECK);
    $conn = NULL;
    echo $datap;
    /**/
}
?>