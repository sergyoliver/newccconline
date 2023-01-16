<?php // Connection à la base de données
include '../connexion/connectpg.php';
include '../connexion/function.php';
# However the User's Query will be passed to the DB:
$sql = 'SELECT *,enrolement.dateenr as dt from enrolement,agent,zone WHERE idcom=id_commune and idagent=idqag and enrolement.supp=0';
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
        'id' => $row['idenrolement'],
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => [$row['cord_y'],$row['cord_x']],
        ),
        # Pass other attribute columns here
        'properties' => array(
            'nomag' => $row['numag'],
            'nomenr' => $row['nom']." ".$row['pnom'],
            'datecrea' => date_lettreab($row['dt']),
            'p' => 0
        )
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}
header('Content-type: application/json');
$datahs = json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;
echo $datahs;

?>