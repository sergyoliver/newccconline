<?php
ini_set('memory_limit', '1G');
set_time_limit(1000);
/**
 * Created by PhpStorm.
 * User: PC-ALERTEFONCIER
 * Date: 21/11/2022
 * Time: 09:43
 */

function executeSqlFile(){
    /*  $serverName = "127.0.0.1";
      $database = "mabd";
      $uid = 'kassi';
      $pwd = 'kassi';*/
$serverName = "162.215.230.14";
$database = "db_cafecacao9";
$uid = 'rootadmin';
$pwd = 'Knyg79@7';

    $bdd='';
    try {
        $bdd = new PDO(
            "sqlsrv:server=$serverName;Database=$database",
            $uid,
            $pwd,
//            array(
//                //PDO::ATTR_PERSISTENT => true,
//                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//            )
            array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',65536)
        );
    }
    catch(PDOException $e) {
        die("Error connecting to SQL Server: " . $e->getMessage());
    }
   /* $req =file_get_contents("mabd_dbo_tb_comptage_cacao.sql");
    SQL($req); // tu execute la requête avec le fichier sql entier
    */

    $bdd->query(file_get_contents('mabd_dbo_tb_comptage_cacao.sql'));
}
executeSqlFile();