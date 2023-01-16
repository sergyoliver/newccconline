<?php
$serverName = "127.0.0.1";
$database = "bccc";
$uid = 'root';
$pwd = '';/*
$serverName = "162.215.230.10";
$database = "db_cafecacao9";
$uid = 'rootadmin';
$pwd = 'Knyg79@7';
*/
$bdd='';
try{
    $bdd = new PDO ("mysql:host=".$serverName.";dbname=".$database."", "".$uid."", "".$pwd."") or die(print_r($bdd->errorInfo()));


}

catch(Exception $e){
    die("Erreur ! ".$e->getMessage());
}

/*$query = 'select  * from tb_delegation';
$stmt = $bdd->query( $query );


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
}
*/

?>