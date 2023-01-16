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
    const test = fetch("datatest.json");
    console.log(test);
</script>
