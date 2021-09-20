<h1>CONNEXION</h1>
<div id="formUser">
    <form action="?ctrl=security&action=login" method="post">
        <p>
            <input type="email" name="email" id="email" placeholder="E-mail..." required>
        </p>
        <p>
            <input type="password" name="password" id="password" placeholder="Mot de passe..." required>
        </p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <p><input class="greenBtt" type="submit" value="Connexion"></p>
        <p class="txtC">Nouveau membre ? <a href="?ctrl=security&action=register" class="blue-link">Cliquez ici</a></p>
    </form>

</div>
