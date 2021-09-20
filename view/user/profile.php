<?php
    $user = $response["data"]["user"];
    $emprunt = $response["data"]["emprunt"];
    $countEmp = count($emprunt);
?>


<div id="profileContent">
    <div id="profileInfo">
        <div id="pageTitle">
            <h1>PROFILE</h1>
        </div>
        <div class="profileAvatar boxShaddow">
            <img src="public/images/avatar/<?= $user->getAvatar() ?>" alt="Avatar">
            <span id="profileAvatarChangeImg" href="">Edit</span>
        </div>
        <p><strong>Membre :&ensp;</strong><?= $user->getFullName() ?></p>
        <p><strong>E-mail :&ensp;</strong><?= $user->getEmail() ?></p>
        <p><a class="blue-link" href="?ctrl=user&action=formChangePassword">Changer mot de pass</a></p>
        <p><strong>Date de Naissance :&ensp;</strong><?= $user->getDateNaissance() ?></p>
        <p><strong>Adresse :&ensp;</strong><?= $user->getFullAddress() ?></p>
        <p><a class="blue-link" href="?ctrl=user&action=formModifyData">Modifier les données personnelles</a></p>

        <p id="profileLogoutBtt" class="boxShaddow"><a href="?ctrl=security&action=logout">Déconnecter</a></p>
        <p><a class="red-link" href="?ctrl=security&action=deleteAccountConfirmation&emp=<?= $countEmp ?>">Supprimer le compte</a></p>
        
    </div>


    <div id="profileLivresRendus">
        <h1>Liste des Livres empruntés</h1>
        <?php if ($countEmp != 0) { ?>
        <div id="tableList">
            <table style="width: 100%;" class="txtL">
                <thead>
                    <tr>
                        <th class="txtL" >LIVRE</th>
                        <th class="txtC" style="min-width: 110px">DATE EMPRUNT</th>
                        <th class="txtC" style="min-width: 110px">DATE RETOUR</th>
                        <th class="txtC" >RETARD ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emprunt as $emp) { ?>
                        <tr>
                            <td class="txtL" style="width: 175px"><?= $emp->getExemplaire()->getLivre()->getTitre() ?></td>
                            <td class="txtC"><?= $emp->getDateEmprunt() ?></td>
                            <td class="txtC" style="<?php if ($emp->getDateRetour() == $emp->getDateToday() ) echo "background-color: rgb(233, 193, 101)"; ?>"><?= $emp->getDateRetour() ?></td>
                            <td class="txtC" style="min-width: 100px">
                                <?php if ($emp->getRetard() > 0) { ?>
                                <p class="livreIndispo"><?php echo $emp->getRetard(); if ($emp->getRetard() == 1) echo " JOUR"; else echo " JOURS"; ?></p></td>
                                <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
            <h3>Vous n'avez aucun livre prêté.<br>
            <p><a class="blue-link" href="?ctrl=livre&action=index">Vérifiez les livres disponibles.</a></p>
            </h3>
        <?php } ?>
    </div>

</div>

<div class="modalWindow">
    <?php include "view/user/formUserAvatar.php" ?>
</div>

<script src="public/js/scriptProfile.js"></script>
