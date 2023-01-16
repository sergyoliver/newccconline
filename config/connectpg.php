<?php
/*$serverName = "127.0.0.1";
$database = "mabd";
$uid = 'kassi';
$pwd = 'kassi';*/
$serverName = "162.215.230.14";
$database = "db_cafecacao9";
$uid = 'rootadmin';
$pwd = 'Knyg79@7';


try {
    $bdd = new PDO(
        "sqlsrv:server=$serverName;Database=$database",
        $uid,
        $pwd,
        array(
            //PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
}
catch(PDOException $e) {
    die("Error connecting to SQL Server: " . $e->getMessage());
}
$query = 'select  * from tb_delegation';
$stmt = $bdd->query( $query );
/**/

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
}


?>