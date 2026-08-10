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
function insert_into_animes($author_name, $titre_vo_anime, $titre_vo_anime_jp, $titre_alternatif_anime, $nb_total_episodes, $release_date, $cover_image, $synopsis) {
    $connection = db_connect();
    $synopsis = mysqli_real_escape_string($connection, $synopsis);

    $sql = "INSERT INTO animes (author_name, titre_vo_anime, titre_vo_anime_jp, titre_alternatif_anime, nb_total_episodes, release_date, cover_image, synopsis) VALUES
    ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');" ;
    $sql = sprintf($sql, $author_name, $titre_vo_anime, $titre_vo_anime_jp, $titre_alternatif_anime, $nb_total_episodes, $release_date, $cover_image, $synopsis) ;

    return execute_query($sql);
}
// ----------------------------------------------------------------------------
// MODIFICATION-SUPPRESSION ANIME:
function update_anime($anime_id, $author_name, $titre_vo_anime, $titre_vo_anime_jp, $titre_alternatif_anime, $nb_total_episodes, $release_date, $cover_image, $synopsis) {
    $connection = db_connect();
    $synopsis = mysqli_real_escape_string($connection, $synopsis);
    
    $sql = "UPDATE animes SET
    author_name = '%s',
    titre_vo_anime = '%s', 
    titre_vo_anime_jp = '%s',
    titre_alternatif_anime = '%s',
    nb_total_episodes = '%s', 
    release_date = '%s',
    cover_image = '%s',
    synopsis = '%s'    
    WHERE anime_id = '%s'; " ;
    $sql = sprintf($sql, $author_name, $titre_vo_anime, $titre_vo_anime_jp, $titre_alternatif_anime, $nb_total_episodes, $release_date, $cover_image, $synopsis, $anime_id) ;
    
    return execute_query($sql) ;
}
function delete_anime($anime_id) {
    $sql = "DELETE FROM animes 
    WHERE anime_id = '%s' ;" ;
    $sql = sprintf($sql, $anime_id) ;

    return execute_query($sql) ;
}
// ----------------------------------------------------------------------------
// INSCRIPTION et LOGIN
function check_user($username, $mdp){
    $sql = "SELECT count(prenom) as nb from users WHERE prenom='%s' AND mot_de_passe='%s';";
    $sql = sprintf($sql, $username, $mdp);
    return get_one_line($sql);
}

function add_user($nom, $prenom, $date_de_naissance, $email, $mot_de_passe){
    $sql = "INSERT INTO users (nom, prenom, date_de_naissance, email, mot_de_passe) VALUES
        ('%s','%s','%s','%s','%s');";
    $sql = sprintf($sql, $nom, $prenom, $date_de_naissance, $email, $mot_de_passe);
    execute_query($sql);
}
// ----------------------------------------------------------------------------
// GET ALL : 
function get_all_animes() {
    $sql = "SELECT * 
    FROM animes; " ;

    return get_all_lines($sql) ;
}
function get_all_animes_tri_date($value_i) {
    $value_f = '' ;
    if ($value_i === "recent") {
        $value_f = 'DESC' ;
    }
    else if ($value_i === "ancien") {
        $value_f = 'ASC' ;
    }
    
    $sql = "SELECT * 
    FROM animes
    GROUP BY release_date %s; " ;
    $sql = sprintf($sql, $value_f) ;

    return get_all_lines($sql) ;
}
function get_all_genres(){
    $sql = "SELECT * 
    FROM genres
    order by genre_nom asc; " ;

    return get_all_lines($sql) ;
}
function get_genres_by_anime_id($anime_id) {
    $sql = "SELECT * 
    FROM anime_genre 
    WHERE anime_id = '%s'; " ;
    $sql = sprintf($sql, $anime_id) ;

    return get_all_lines($sql) ;
}
function get_all_animes_tri_genre($genre_id){
    $sql = "SELECT * FROM anime_genre a_g 
        JOIN animes a ON a.anime_id = a_g.anime_id 
        JOIN genres g ON g.genre_id = a_g.genre_id 
        where g.genre_id = '%s'
        order by g.genre_nom asc, a.titre_vo_anime asc;";
    $sql = sprintf($sql, $genre_id);

    return get_all_lines($sql);
}
function get_all_animes_tri_alpha($value_i){
    $value_f = '' ;
    if ($value_i === "alpha_desc") {
        $value_f = 'DESC' ;
    }
    else if ($value_i === "alpha_asc") {
        $value_f = 'ASC' ;
    }

    $sql = "SELECT * FROM anime_genre a_g 
        JOIN animes a ON a.anime_id = a_g.anime_id 
        JOIN genres g ON g.genre_id = a_g.genre_id 
        group by a.titre_vo_anime
        order by a.titre_vo_anime %s;";
    $sql = sprintf($sql, $value_f);
    return get_all_lines($sql);
}
// -------------------------------------------------------------------------------
// GET ONE : 
function get_one_user($user_id) {
    $sql = "SELECT * 
    FROM users 
    WHERE user_id = '%s';" ;
    $sql = sprintf($sql, $user_id) ;

    return get_one_line($sql) ;
}
function get_one_user_by($username, $password) {
    $sql = "SELECT * 
    FROM users 
    WHERE prenom = '%s' AND mot_de_passe = '%s'; " ;
    $sql = sprintf($sql, $username, $password) ;

    return get_one_line($sql) ;
}
function get_one_anime($anime_id) {
    $sql = "SELECT * 
    FROM animes 
    WHERE anime_id = '%s';" ;
    $sql = sprintf($sql, $anime_id) ;

    return get_one_line($sql) ;
}
function get_genre_by_genre_id($genre_id) {
    $sql = "SELECT * 
    FROM genres 
    WHERE genre_id = '%s'; " ;
    $sql = sprintf($sql, $genre_id) ;

    return get_one_line($sql) ;
}

?>