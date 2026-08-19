<?php
include_once 'db_connect.php';

function get_all_lines($sql){
    // echo $sql;
    $req = mysqli_query(db_connect(),$sql );
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error(db_connect()));
    }
    $result = array();
    while ($line = mysqli_fetch_assoc($req)) {
        $result[] = $line;
    }
    mysqli_free_result($req);
    return $result;
}

function get_one_line($sql){
    // echo $sql ;
    $req = mysqli_query(db_connect(),$sql );
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error(db_connect()));
    }
    $result = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $result;
}

function execute_query($sql){
    echo $sql ;
    $req = mysqli_query(db_connect(), $sql);
    if (!$req) {
        die('Erreur SQL : ' . mysqli_error(db_connect()));
    }
    return $req;
}

function get_enum_values($nom_table, $nom_column) {
    $sql = "SHOW COLUMNS FROM %s LIKE '%s'" ;
    $sql = sprintf($sql, $nom_table, $nom_column) ;
    
    $result = mysqli_query(db_connect(), $sql);
    // $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $type = $row['Type']; // enum('Homme','Femme','Autre')

    // Nettoyage pour obtenir les valeurs
    preg_match_all("/'([^']+)'/", $type, $matches);
    return $matches[1]; // ['Homme', 'Femme', 'Autre']
}

// -------------------------------------------------------------------------
// INSERT :
function insert_into_historique_depot_retrait($type_d_r, $personne_id, $raison, $montant) {
    $last_transaction = get_last_line_transaction() ;
    if ($last_transaction == NULL) {
        $solde_initial = 0 ;
    }
    else {
        $solde_initial = $last_transaction['solde_final'] ;    
    }

    $solde_f = 0 ;
    if ($type_d_r === 'depot') { // +
        $solde_final = $solde_initial + $montant ;
    }
    else if ($type_d_r === 'retrait') { // -
        $solde_final = $solde_initial - $montant ;
    }

    $sql = "INSERT INTO historique_depot_retrait (type_d_r, personne_id, raison, solde_initial, montant, solde_final)
    VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";
    $sql = sprintf($sql, $type_d_r, $personne_id, $raison, $solde_initial, $montant, $solde_final);

    return execute_query($sql) ;
}
// ----------------------------------------------------------------------------
// MODIFICATION-SUPPRESSION:
// ----------------------------------------------------------------------------
// INSCRIPTION et LOGIN :
// ----------------------------------------------------------------------------
// GET ALL : 
function get_all_personnes() {
    $sql = "SELECT * 
    FROM personnes;" ;

    return get_all_lines($sql) ;
}
function get_all_historique_depot() {
    $sql = "SELECT * 
    FROM historique_depot;" ;

    return get_all_lines($sql) ;
}
// -------------------------------------------------------------------------------
// GET ONE : 
function get_one_personne($personne_id) {
    $sql = "SELECT * 
    FROM personnes 
    WHERE personne_id = '%s';" ;
    $sql = sprintf($sql, $personne_id) ;

    return get_one_line($sql) ;
}
function get_last_line_transaction() {
    $sql = "SELECT * 
    FROM historique_depot_retrait 
    ORDER BY historique_depot_retrait_id DESC 
    LIMIT 1; " ;
    return get_one_line($sql) ;
}
// -------------------------------------------------------------------------------
// AUTRE : 
function get_the_total($montant, $last_vola) {
    if ($last_vola === NULL) {
        $last_vola = 0 ;
    }
    return ($montant + $last_vola) ;
}
?>