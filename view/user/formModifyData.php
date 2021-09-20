<?php 
    use App\Service\Session;
    if (!Session::isAnonymous()) {
        $user = Session::getUser();
    }
?>

<div id="pageTitle">
    <h1>MODIFIER LES DONNÉES PERSONNELLES</h1>
</div>

<div id="formUser" class="boxShaddow">
    <form action="?ctrl=security&action=modifyData" method="post">
        <p>
            <input type="text" name="nom" id="nom" placeholder="NOM" required value="<?= $user->getNom() ?>">
        </p>
        <p>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required value="<?= $user->getPrenom() ?>">
        </p>
        <p>
            <input type="date" name="dn" id="dn" placeholder="Date Naissance" required value="<?= $user->getDateNaissance("Y-m-d") ?>">
        </p>

        <p>
            <input type="text" name="adresse" id="adresse" placeholder="Adresse" required value="<?= $user->getAdresse() ?>">
        </p>
        <p>
            <input type="text" name="cp" id="cp" placeholder="CP" required value="<?= $user->getCp() ?>">
        </p>
        <p>
            <input type="text" name="city" id="city" placeholder="Ville" required value="<?= $user->getcity() ?>">
        </p>

        <p>
            <p class="emailModify txtC" style="color:darkred">Si vous modifiez votre adresse e-mail,<br>vous devrez vous reconnecter.</p>
            <input type="email" name="email" id="email" placeholder="Email" required value="<?= $user->getEmail() ?>">
        </p>

        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        
        <a href="?ctrl=user&action=profile"><p class="cancelBtt txtC">Annuler</p></a>
        <p><input class="greenBtt" type="submit" value="Sauvegarder"></p>
    </form>
</div>