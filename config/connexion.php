<?php
try{
    $db= new PDO("mysql:host=localhost; dbname=gestionstagiaire_v1",'root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo 'Erreur :'.$e->getMessage();
}
?>
