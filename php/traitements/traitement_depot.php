<?php 
include("../inc/functions.php") ;
echo $_GET['personne_id'];
echo $_GET['raison_titre'];
echo $_GET['montant'];

$last_vola = 100 ;

$personne_id = $_GET['personne_id'];
$raison_titre  = $_GET['raison_titre'];
$montant  = $_GET['montant'];
$total = get_the_total($_GET['montant'], $last_vola) ;

// Insertion : 
insert_into_historique_depot($personne_id, $raison_titre, $montant, $total) ;

$historique_depot = get_all_historique_depot() ;
for ($i=0; $i <= count($historique_depot)-1 ; $i++) { 
    echo $historique_depot[$i]['historique_depot_id'] ;
    echo $historique_depot[$i]['the_date'] ;
    echo $historique_depot[$i]['personne_id'] ;
    echo $historique_depot[$i]['raison_titre'] ;
    echo $historique_depot[$i]['montant'] ;
    echo $historique_depot[$i]['total'] ;
}

?>