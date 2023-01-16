<?php

   $dbname = "postgres";
    $host = "localhost";
    $dbuser = "postgres";
    $dbpass = "admin";
/*

$dbname = "Bdservitude";
$host = "162.144.157.145";
$dbuser = "Adminservitude";
$dbpass = "Adminservitude";
*/

try{
        $bdd = new PDO ("pgsql:host=".$host.";dbname=".$dbname."", "".$dbuser."", "".$dbpass."") or die(print_r($bdd->errorInfo()));


    }

    catch(Exception $e){
        die("Erreur ! ".$e->getMessage());
    }



exec("pg_dump  mabase") ;

/*
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=a2cmimbo_bd;charset=utf8', 'a2cmimbo_user1', 'vaH8dfM6L2Fb',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)

{

    echo 'Erreur : '.$e->getMessage().'<br />';

    echo 'N° : '.$e->getCode();

}*/
?>