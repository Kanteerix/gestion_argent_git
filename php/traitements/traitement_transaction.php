<?php 
include("../inc/functions.php") ;

$personne_id = $_GET['personne_id'] ; 
$type_d_r = $_GET['choix'] ;
$raison = $_GET['raison'] ;
$montant = $_GET['montant'] ;

insert_into_historique_depot_retrait($type_d_r, $personne_id, $raison, $montant) ; 
