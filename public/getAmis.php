<?php
$pdo = require 'connexion.php';
$numAction = $_GET['action'];


$sql = "SELECT * FROM inscription";
$statement = $pdo->query($sql);
$amiInscris = array();

$inscriptions = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($inscriptions as $inscription){
    if($inscription['action_id'] == $numAction){
        $amiInscris[]= $inscription['amis_id'];
    }
}

$sql = "SELECT * FROM amis";
$statement = $pdo->query($sql);

$amis = $statement->fetchAll(PDO::FETCH_ASSOC);
$array = array();
foreach ($amis as $ami){
    if(!in_array($ami['id'], $amiInscris) ){
        $array[] = $ami;
    }
}
echo json_encode($array);