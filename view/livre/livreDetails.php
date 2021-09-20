<?php
    use App\Service\Session;
    $isAdmin = (Session::isRoleUser("ROLE_ADMIN")) ? true : false;
    $livre = $response["data"]["livre"]; //Table: livre
    $emprunt = $response["data"]["emprunt"]; //Table: Emprunt
?>

<div id="pageTitle">
    <h1><?= $livre->getTitre() ?></h1>
</div>

<div id="livreDetails">
    <div>
        <img class="boxShaddow" src="<?= $livre->getImage() ?>" alt="Livre">
    </div>
    <div>
        <p><strong>Auteur : </strong><span><?= $livre->getAuteur()->getFullName() ?></span></p>
        <p><strong>Année de parution : </strong><span><?= $livre->getAnnee() ?></span></p>
        <p><strong>Pages : </strong><span><?= $livre->getNbPages() ?></span></p>
        <p><strong>Exemplaires disponibles : </strong><span><?= $livre->getResume() ?></span></p>
    </div>
</div>

<?php if ($isAdmin) { ?>
<div id="empruntDetails">
    <div id="tableList">
        <table style="width: 100%;" class="txtL">
            <thead>
                <tr>
                    <th class="txtC" style="width: 75px">EXEMP. Nº</th>
                    <th>MEMBRE</th>
                    <th class="txtC" style="min-width: 110px">DEPUIS LE</th>
                    <th class="txtC">DELAI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprunt as $emp) { ?>
                <tr>
                    <td class="txtC" style="width: 75px"><?= $emp->getId() ?></td>
                    <td><a class="blue-link" href="?ctrl=user&action=userDetails&id=<?= $emp->getUser()->getId() ?>"><?= $emp->getUser()->getFullName() ?></a></td>
                    <td class="txtC" style="min-width: 110px"><?= $emp->getDateEmprunt() ?></td>
                    <td class="txtC"><?= $emp->getDelai() ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>