<?php 
include("../php/inc/functions.php") ;
$all_personnes = get_all_personnes() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPOT</title>
</head>
<body>
    <head>

    </head>
    <main>
        <form action="../php/traitement_depot.php" method="get">
            <label for="personne">Personne : </label>
            <select name="personne" id="personne">
                <?php 
                for ($i=0; $i <= count($all_personnes)-1 ; $i++) { ?>
                    <option value="<?= $all_personnes[$i]['personne_id'] ?>" 
                        <?= $all_personnes[$i]['personne_name']=="Dada" ? "selected" : "" ?>>
                        <?= $all_personnes[$i]['personne_name'] ?>
                    </option>
                <?php }
                ?>
            </select><br>
            <label for="raison_titre">Titre RAISONS : </label>
            <input type="text" id="raison_titre"><br>
            <label for="montant">Montant : </label>
            <input type="number" id="montant"><br>
            <input type="submit" value="Deposer">
        </form>
    </main>
    <footer>
        
    </footer>
</body>
</html>