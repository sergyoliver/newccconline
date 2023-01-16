<?php
$serverName = "sql8001.site4now.net";
$database = "db_a8d4f3_pccc";
$uid = 'db_a8d4f3_pccc_admin';
$pwd = 'KJDngebmb4bd07';
/*$serverName = "127.0.0.1";
$database = "mabd";
$uid = 'kassi';
$pwd = 'kassi';

db: db_a8d4f3_pccc
user : db_a8d4f3_pccc_admin
host: sql8001.site4now.net
pwd: KJDngebmb4bd07 */

try {
    $conn = new PDO(
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

echo "<p>Connected to SQL Server</p>\n";

echo "<p>PDO::ATTR_PERSISTENT value:</p>\n";

echo "<pre>";
echo var_export($conn->getAttribute(PDO::ATTR_PERSISTENT), true);
echo "</pre>";

echo "<p>PDO::ATTR_DRIVER_NAME value:</p>\n";

echo "<pre>";
echo var_export($conn->getAttribute(PDO::ATTR_DRIVER_NAME), true);
echo "</pre>";

echo "<p>PDO::ATTR_CLIENT_VERSION value:</p>\n";

echo "<pre>";
echo var_export($conn->getAttribute(PDO::ATTR_CLIENT_VERSION), true);
echo "</pre>";


$query2 = 'select  * from tbvillage WHERE id=3';
$stmt2 = $conn->prepare( $query2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$stmt2->execute();
$nb =$stmt2->rowCount();
echo 'Test : '. $nb.'<br />';




echo "<pre>";

$query = 'select  * from tbvillage';
$stmt = $conn->query( $query );

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
}
echo "</pre>";

$stmt3 = $conn->prepare("INSERT INTO tbvillage (id, code_village,designation,sous_prefecture_code)
 VALUES (:id, :code,:lib,:sp)");

if ($stmt3) {
    $stmt3->bindValue(1, 2);
    $stmt3->bindValue(2, "V002");
    $stmt3->bindValue(3, "koko");
    $stmt3->bindValue(4, "003");

    if ($stmt3->execute()) {
        echo "Execution succeeded\n";
    } else {
        echo "Execution failed\n";
    }
}

// Free statement and connection resources.
$stmt = null;
$conn = null;
?>