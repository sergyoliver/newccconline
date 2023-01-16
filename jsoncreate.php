<?php
/**
 * Created by PhpStorm.
 * User: PC-ALERTEFONCIER
 * Date: 25/11/2022
 * Time: 13:49
 */
/*$json = file_get_contents("datatest.json");

$parsed_json = json_decode($json);
 $date_jour = $parsed_json->{'response'};*/
 //var_dump($parsed_json);
//var_dump($date_jour);
include 'connexion/connectpg.php';
include 'connexion/function.php';
$rsan = $bdd->prepare("SELECT idpassage,an_campagne FROM tb_comptage_cacao   GROUP BY idpassage,an_campagne ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$rsan->execute();
// $rowan = $rsan->rowCount();
$row = $rsan->fetchAll(PDO::FETCH_ASSOC);


$json = json_encode($row);
//display it
echo "$json";
//generate json file
file_put_contents("json/test.json", $json);
?>
<script>
    /*var request = new XMLHttpRequest();
    request.open('GET',"datatest.json");
    request.send();
    console.log(request.responseText);

    request.addEventListener('load', function () {
        console.log(this.responseText)
    })*/
</script>
<script>
   const test = fetch("json/test.json");
    console.log(test);
</script>
