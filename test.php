<?php

include 'connexion/connectpg.php';
include 'connexion/function.php';
$rsc = $conn->prepare('select * from tbvillage where id= :iduser or id= :id', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$rsc->execute(array('iduser' => 1,'id' => 2));
$nbc = $rsc->rowCount();
echo $nbc;