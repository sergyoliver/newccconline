<?php

    $serverName = "SQL8002.site4now.net";
    $database = "db_a8d4f3_kassi";
    $uid = 'db_a8d4f3_kassi_admin';
    $pwd = 'KJDngebmb4bd07';
    $port ="1433";
    
    try {
        $conn = new PDO(
            "sqlsrv:server=$serverName;Database=$database",
            $uid,
            $pwd
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die("Error connecting to SQL Server: " . $e->getMessage());
    }
 die("Connextion to sql server with PDO done ");
?>