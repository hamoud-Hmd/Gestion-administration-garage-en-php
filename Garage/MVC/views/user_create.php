<form method="POST">
    <?php print_r($errors) ?>
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" name="pseudo" type="text"
               class="form-control" placeholder="Enter votre pseudo"
               value="<?php echo (isset($_POST['pseudo'])) ? $_POST['pseudo'] : '' ?>"
               required />
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" class="form-control" required />
    </div>
    <div class="form-group">
        <label for="email">Adresse mail</label>
        <input id="email" name="email" type="email"
               class="form-control" placeholder="Enter votre email au format nom@mail.com"
               value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>"
               required />
        <small class="form-text text-muted">Un email valide est requie !</small>
    </div>
    <div class="form-group">
        <label for="dateNaissance">Date de naissance</label>
        <input id="dateNaissance" name="dateNaissance" type="date" class="form-control"
               value="<?php echo (isset($_POST['dateNaissance'])) ? $_POST['dateNaissance'] : ''; ?>"
               required />
        <small class="form-text text-muted">Une date valide est requise !</small>
    </div>
    <input type="submit" class="btn btn-success btn-block" name="submitCreate" value="Valider mon inscription" />
</form>