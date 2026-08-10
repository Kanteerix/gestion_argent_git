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
// -------------------------------------------------------------------------
// INSERT :
// ----------------------------------------------------------------------------
// MODIFICATION-SUPPRESSION ANIME:
// ----------------------------------------------------------------------------
// INSCRIPTION et LOGIN
// ----------------------------------------------------------------------------
// GET ALL : 
function get_all_personnes() {
    $sql = "SELECT * 
    FROM personnes;" ;

    return get_all_lines($sql) ;
}

// -------------------------------------------------------------------------------
// GET ONE : 

?>