<?php 
include("../php/inc/functions.php") ;

$nom_table = "historique_depot_retrait" ;
$nom_column = "type_d_r" ;

$all_personnes = get_all_personnes() ;

$value_types = get_enum_values($nom_table, $nom_column) ;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSACTIONS</title>
</head>
<body>
    <head>
        <a href="../index.php">Retour Accueil (choix)</a>
    </head>
    <main>
        <form action="../php/traitements/traitement_transaction.php" method="get">
            <label for="personne">Personne : </label>
            <select name="personne_id" id="personne">
                <?php 
            for ($i=0; $i <= count($all_personnes)-1 ; $i++) { ?>
                <option value="<?= $all_personnes[$i]['personne_id'] ?>" 
                <?= $all_personnes[$i]['personne_name']=="Dada" ? "selected" : "" ?>>
                <?= $all_personnes[$i]['personne_name'] ?>
                </option>
            <?php } ?>
            </select><br>
            <label for="choix">Choix : </label>
            <select name="choix" id="choix">
                <?php 
                foreach ($value_types as $v_t) { ?>
                <option value="<?= $v_t ?>"><?= $v_t ?></option>
                <?php }
                ?>
            </select><br>
            <label for="raison">Titre RAISONS : </label>
            <input type="text" name="raison" id="raison"><br>
            <label for="montant">Montant : </label>
            <input type="number" name="montant" id="montant"><br>
            <input type="submit" value="Deposer">
        </form>
    </main>
    <footer>
        
    </footer>
</body>
</html>