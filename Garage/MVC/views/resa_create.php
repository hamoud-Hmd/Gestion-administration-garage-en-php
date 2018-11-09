<form method="POST">
    <?php print_r($errors) ?>
    <div class="form-group">
        <label for="cars">Choisissez un véhicule</label>
        <select id="cars" name="cars" class="form-control">

            <?php
            // Génère mes options depuis ma fonction getConstructor
            // Fonction qui récupère dans la base de donnée
            foreach ($cars as $key => $value) {
                //$select = (isset($_POST['constructeur']) && ($_POST['constructeur'] == $value['con_id'])) ? "selected" : "";
                ?>
                <option value="<?php echo $value['gar_id']; ?>" <?php //echo $select; ?>>
                    <?php echo $value['gar_modele']; ?> <?php echo $value['gar_prix']; ?> <?php echo $value['gar_annee']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="dateResa">Date de Réservation</label>
        <input id="dateResa" name="dateResa" type="date" class="form-control"
               value="<?php echo (isset($_POST['dateResa'])) ? $_POST['dateResa'] : ''; ?>"
               required />
        <small class="form-text text-muted">Une date valide est requise !</small>
    </div>
    <div class="form-group">
        <label for="sommeVersee">Somme versee</label>
        <input id="sommeVersee" name="sommeVersee" type="number" class="form-control"
               value="<?php echo (isset($_POST['sommeVersee'])) ? $_POST['sommeVersee'] : ''; ?>"
               required />
    </div>
    <div class="form-group">
        <label for="typePaiement">Type Paiement</label>
        <select id="typePaiement" name="typePaiement" class="form-control">

            <?php
            // Génère mes options depuis ma fonction getConstructor
            // Fonction qui récupère dans la base de donnée
            foreach ($typePaiement as $key => $value) {
                //$select = (isset($_POST['constructeur']) && ($_POST['constructeur'] == $value['con_id'])) ? "selected" : "";
                ?>
                <option value="<?php echo $key; ?>" <?php //echo $select; ?>>
                    <?php echo $value; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>
    <input type="submit" class="btn btn-success btn-block" name="submitCreate" value="Valider ma résa" />
</form>