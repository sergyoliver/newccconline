<?php // Connection à la base de données
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (!empty($_GET['p']) && $_GET['k']==0 ) {


# However the User's Query will be passed to the DB:
    $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle where nom_coop =:n ';
# Try query or error
    $rs = $bdd->prepare($sql);
    if (!$rs) {
        echo 'An SQL error occured.\n';
        exit;
    }
    $rs->execute(array('n' => $_GET['p']));
}
if (!empty($_GET['p']) && $_GET['k']==1 ) {


# However the User's Query will be passed to the DB:
     $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,fc_4326_1 where nom_coop =:n and  ST_Intersects(table_parcelle.geom, fc_4326_1.geom) ';
# Try query or error
    $rs = $bdd->prepare($sql);
    if (!$rs) {
        echo 'An SQL error occured.\n';
        exit;
    }
    $rs->execute(array('n' => $_GET['p']));

}
if (!empty($_GET['p']) && $_GET['k']==2 ) {


# However the User's Query will be passed to the DB:
     $sql = 'SELECT *, ST_AsGeoJSON(ST_Transform((table_parcelle.geom),4326),15) AS g  from table_parcelle,km2_4326 where nom_coop =:n and  ST_Intersects(table_parcelle.geom, km2_4326.geom) ';
# Try query or error
    $rs = $bdd->prepare($sql);
    if (!$rs) {
        echo 'An SQL error occured.\n';
        exit;
    }
    $rs->execute(array('n' => $_GET['p']));

}

# Build GeoJSON feature collection array
$geojson = array(
    'type'      => 'FeatureCollection',
    'features'  => array()
);
# Loop through rows to build feature arrays
while($row = $rs->fetch()) {
if (empty($row['noms'])){
    $nom = "aucun";
}else{
    $nom = $row['noms'];
}
    $feature = array(
        'gidcoo' => $row['gid'],
        'type' => 'Feature',
       'geometry' => json_decode($row['g'], true),
       /*  'geometry' => array(
            'type' => 'Point',
            'coordinates' => [$row['long'],$row['lat']],
        ),*/
        # Pass other attribute columns here
        'properties' => array(
            'nomp' => $nom ,
            'nomc' => $row['nom_coop'],
            'nomsection' => $row['nom_sec'],
            'supp' => round($row['sup_ha'],1),
            'genre' => $row['sexe']

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