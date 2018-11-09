<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>id</th>
        <th>Modèle</th>
        <th>Type de carburant</th>
<!--        <th>Quantitée</th>-->
        <th>Prix à l'unitée</th>
<!--        <th>Prix total</th>-->
        <th>Date résa</th>
        <th>% versé</th>
        <th>Som. versée</th>
        <th>Reste</th>
        <th>Pénalité</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalFinal = 0;
    foreach ($values as $value) {
        $total = $value['gar_prix'] * $value['gar_nbrVoiture'];
        $totalFinal += $total;
        $dateResa = new \DateTime($value['res_date']);
        ?>
        <tr>
            <td><?php echo $value['gar_id']; ?></td>
            <td><?php echo $value['gar_modele']; ?></td>
            <td><?php echo ucfirst($value['gar_carburant']); ?></td>
<!--            <td>--><?php //echo $value['gar_nbrVoiture']; ?><!--</td>-->
            <td style="text-align: right;"><?php echo number_format($value['gar_prix'],0,'.', ' ') . ' €'; ?></td>
<!--            <td>--><?php //echo $total . ' €'; ?><!--</td>-->
            <td><?php echo $dateResa->format('d/m/Y'); ?></td>
            <td style="text-align: right;"><?php echo number_format((($value['res_somme_versee']/$value['gar_prix']) * 100), 2, '.', ' '). '%';?></td>
            <td style="text-align: right;"><?php echo (($value['res_somme_versee']) ? number_format($value['res_somme_versee'],0,'.', ' ') : 0) . ' €'; ?></td>
            <td style="text-align: right;"><?php echo number_format($value['gar_prix'] - $value['res_somme_versee'],0,'.', ' ') . ' €'; ?></td>
            <td style="text-align: right;"><?php echo number_format($value['res_penalite'],0,'.', ' ') . ' €'; ?></td>
            <td style="text-align: right;">
                <a class="btn btn-primary" href="/index.php/resa/valid?idResa=<?php echo $value['res_id'] ?>">Validé</a>
                <a class="btn btn-primary" href="/index.php/resa/cancel?idResa=<?php echo $value['res_id'] ?>">Annulé</a>
                <a class="btn btn-primary" href="/index.php/resa/updateResa?idResa=<?php echo $value['res_id'] ?>">Update</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4"></td>
        <td><span class="float-right">Total :</span></td>
        <td><?php echo $totalFinal . ' €'; ?></td>
    </tr>
    </tfoot>
</table>