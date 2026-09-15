<?php 
include("../php/inc/functions.php") ;
$all_transactions = get_all_historique_depot_retrait() ;
function convert_into_fmg($ariary) {
    $fmg = $ariary * 5 ;
    return $fmg ;
}
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
        <table border=1 width=100%>
            <tr>
                <th>Type</th>
                <th>Date</th>
                <th>Solde initial<br>(Ar | Fmg)</th>
                <th>Personne</th>
                <th>Raison</th>
                <th>Montant<br>(Ar | Fmg)</th>
                <th>Solde final<br>(Ar | Fmg)</th>
            </tr>
            <?php 
            for ($i=0; $i <= count($all_transactions)-1 ; $i++) { ?>
                <tr style="background-color:<?= depot_retrait_color($all_transactions[$i]['type_d_r']) ?>">
                    <td><?= $all_transactions[$i]['type_d_r'] ?></td>
                    <td><?= $all_transactions[$i]['the_date'] ?></td>
                    <td>
                        <table border=1 width=100%>
                            <tr>
                                <td width=50%><?= $all_transactions[$i]['solde_initial'] ?></td>
                                <td width=50%><?= convert_into_fmg($all_transactions[$i]['solde_initial'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?= get_one_personne($all_transactions[$i]['personne_id'])['personne_name'] ?></td>
                    <td><?= $all_transactions[$i]['raison'] ?></td>
                    <td>
                        <table border=1 width=100%>
                            <tr>
                                <td width=50%><?= $all_transactions[$i]['montant'] ?></td>
                                <td width=50%><?= convert_into_fmg($all_transactions[$i]['montant'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border=1 width=100%>
                            <tr>
                                <td width=50%><?= $all_transactions[$i]['solde_final'] ?></td>
                                <td width=50%><?= convert_into_fmg($all_transactions[$i]['solde_final'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>