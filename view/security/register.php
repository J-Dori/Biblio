<div id="pageTitle">
    <h1>INSCRIPTION</h1>
</div>

<div id="formUser" class="boxShaddow">
    <form action="?ctrl=security&action=register" method="post">
        <p>
            <input type="text" name="nom" id="nom" placeholder="NOM" required>
        </p>
        <p>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
        </p>
        <p>
            <input type="date" name="dn" id="dn" placeholder="Date Naissance" required>
        </p>

        <p>
            <input type="text" name="adresse" id="adresse" placeholder="Adresse" required>
        </p>
        <p>
            <input type="text" name="cp" id="cp" placeholder="CP" required>
        </p>
        <p>
            <input type="text" name="city" id="city" placeholder="Ville" required>
        </p>

        <p>
            <input type="email" name="email" id="email" placeholder="E-mail..." required>
        </p>
        <p>
            <input type="password" name="password" id="password" placeholder="Mot de passe..." required>
        </p>
        <p>
            <input type="password" name="password_repeat" id="password_repeat" placeholder="Répétez le mot de passe..." required>
        </p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <p><input class="greenBtt" type="submit" value="Sauvegarder"></p>
    </form>
</div>
