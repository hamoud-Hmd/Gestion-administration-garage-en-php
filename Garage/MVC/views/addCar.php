<div id="alert" class="divAlert"><h1>"Faut remplir tous les champs"</h1></div>
<form method="POST">
    <label for="constructor">Choisissez le constructeur</label>
    <select id="constructor" name="constructor" class="form-control">

        <?php
        // Génère mes options depuis ma fonction getConstructor
        // Fonction qui récupère dans la base de donnée
        foreach ($carModeles as $key => $value) {
            $select = (isset($_POST['constructor']) && ($_POST['constructor'] == $value['con_id'])) ? "selected" : "";
            ?>
            <option value="<?php echo $value['con_id']; ?>" <?php echo $select; ?>>
                <?php echo $value['con_nom']; ?>
            </option>
            <?php
        }
        ?>
    </select>
    <div class="form-group">
        <label for="model">Modèle des véhicules</label>
        <input id="model" name="modele" value="<?php echo (isset($_POST['modele'])) ? $_POST['modele'] : ''; ?>" type="text" class="form-control" placeholder="Enter un modèle">
    </div>
    <div class="form-group">
        <label for="typeCarb">Type de carburant utilisé</label>
        <input id="typeCarb" name="typeCarb" value="<?php echo (isset($_POST['typeCarb'])) ? $_POST['typeCarb'] : ''; ?>" type="text" class="form-control" placeholder="Enter un type de carburant">
    </div>
    <div class="form-group">
        <label for="quantity">Quantitée de véhicule</label>
        <input id="quantity" name="quantity" value="<?php echo (isset($_POST['quantity'])) ? $_POST['quantity'] : ''; ?>"type="number" class="form-control" placeholder="Enter une quantitée">
        <small class="form-text text-muted">Seulement de chiffre, pas de caractère spéciaux</small>
    </div>
    <div class="form-group">
        <label for="prix">Prix à l'unitée</label>
        <input id="prix" name="prix" value="<?php echo (isset($_POST['prix'])) ? $_POST['prix'] : ''; ?>"type="number" class="form-control" placeholder="Enter une valeur">
        <small class="form-text text-muted">Seulement de chiffre, pas de caractère spéciaux</small>
    </div>
    <input type="submit" class="btn btn-success btn-block" value="Valider mon ajout" onClick = "">
</form>