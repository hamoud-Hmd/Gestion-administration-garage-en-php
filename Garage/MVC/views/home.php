<div class="alert alert-danger">
    <p>Vous devez être connecté pour accèder à cette page</p>
</div>
<form method="POST">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" name="pseudo" type="text"
               class="form-control" placeholder="Enter votre pseudo"
               value="<?php (isset($_POST['pseudo'])) ? $_POST['pseudo'] : '' ?>"
               required />
    </div>
    <div class="form-group">
        <label for="pass">Mot de passe</label>
        <input id="pass" name="pass" type="password" class="form-control" required />
    </div>
    <input type="submit" class="btn btn-success btn-block" name="submitAuth" value="Me connecter" />
</form>
