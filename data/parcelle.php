<?php // Connection à la base de données
ini_set('memory_limit', '-1');
include '../connexion/connectpg.php';
include '../connexion/function.php';
# However the User's Query will be passed to the DB:
 $sql = "SELECT *  from tb_parcelle WHERE   longitude <>''   ";
# Try query or error
$rs=$bdd->prepare($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}
$rs->execute();


# Build GeoJSON feature collection array

$geojson['features']=[];
$geojson = [];


$i=0;
while($row = $rs->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    //echo $i;
if (!empty($nom_parcelle)){$np =$nom_parcelle; }else{$np ='-'; }
//echo $np;
    $feature = [
        "id" => $id,
        "codep" => $code_parcelle,
        //'nomp' =>  $np,
        //'variete' =>  $variete,
        //'superficie' =>  $superficie,
        //'nom_prod' =>  $rowprod['nom'],
        //'dep' =>  $rowdp['designation'],
        'typep' =>  $type_plantation,
        "lon" => $longitude,
        "lat" => $latitude
    ];

    $geojson['features'][] = $feature;

 }

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data =  json_encode($geojson);
echo $data;

?>