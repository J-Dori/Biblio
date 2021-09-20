<div id="pageTitle">
    <h1>Modifier Mot de Pass</h1>
</div>

<div id="formUser" class="boxShaddow">
    <form action="?ctrl=security&action=changePassword" method="post">
        <p>
            <input type="password" name="password" id="password" placeholder="Mot de pass actuel " required>
        </p>
        <p>
            <input type="password" name="password_new" id="password_new" placeholder="Nouveau mot de pass" required>
        </p>
        <p>
            <input type="password" name="password_repeat" id="password_repeat" placeholder="Répétez le nouveau mot de pass" required>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        </p>
        
        <a href="?ctrl=user&action=profile"><p class="cancelBtt txtC">Annuler</p></a>
        <p><input class="greenBtt" type="submit" value="Sauvegarder"></p>
    </form>
</div>