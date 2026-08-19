<?php 
include("../php/inc/functions.php") ;
$all_transactions = get_all_historique_depot_retrait() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des transactions</title>
</head>
<body>
    <header>
        <a href="../index.php">Retour</a>
    </header>
    <main>
        <table border=1>
            <tr>
                <th>Type</th>
                <th>Date</th>
                <th>Solde initial</th>
                <th>Personne</th>
                <th>Raison</th>
                <th>Montant</th>
                <th>Solde final</th>
            </tr>
            <?php 
            for ($i=0; $i <= count($all_transactions)-1 ; $i++) { ?>
                <tr>
                    <td><?= $all_transactions[$i]['type_d_r'] ?></td>
                    <td><?= $all_transactions[$i]['the_date'] ?></td>
                    <td><?= $all_transactions[$i]['solde_initial'] ?></td>
                    <td><?= get_one_personne($all_transactions[$i]['personne_id'])['personne_name'] ?></td>
                    <td><?= $all_transactions[$i]['raison'] ?></td>
                    <td><?= $all_transactions[$i]['montant'] ?></td>
                    <td><?= $all_transactions[$i]['solde_final'] ?></td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>