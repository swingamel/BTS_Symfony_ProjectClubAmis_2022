<?php
$host="localhost";
$dbase="ClubAmis";
$user="root";
$pwd="";
$charset="utf8";
$dns="mysql:host=$host;dbname=$dbase;charset=$charset;";

try{
    $connexion=new pdo($dns,$user,$pwd);
    return $connexion;
    //echo("success");
}
catch (Exeption $e){
    echo("error : ".$e->getMessage());
    die("Erreur : ".$e->getMessage());
}
?>