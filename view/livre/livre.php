<?php
    use App\Service\Session;
    $livre = $response["data"]["list"];
    $available = $response["data"]["available"];
?>

<div id="pageTitle">
    <h1>LIVRES&ensp;</h1>
    <p class="counterRound"><?= $available ?></p>
</div>

<div id="livreFlexBoxes">
    <?php foreach ($livre as $list) { ?>
        <div class="livreBoxes txtC boxShaddow">
            <a href="?ctrl=livre&action=livreDetails&id=<?= $list->getId() ?>">
                <img class="boxShaddow" src="<?= $list->getImage() ?>" alt="Livre">
                <h3 class="blue-link" ><?= $list->convertIfLongTitle() ?></h3>
            </a>
            <p><strong>Auteur : </strong><span><?= $list->getAuteur()->getFullName() ?></span></p>
            <p><strong>Année de parution : </strong><span><?= $list->getAnnee() ?></span></p>
            <p><strong>Pages : </strong><span><?= $list->getNbPages() ?></span></p>
            <p><strong>Exemplaires disponibles : </strong><span><?= $list->getCountExemplaire() ?></span></p>
            <div class="livreDispoBtt">
            <?php if (!Session::isAnonymous()) { if ($list->getCountExemplaire() != 0) { ?>
                <a class="greenBtt boxShaddow" href="?ctrl=livre&action=emprunterLivreDelai&id=<?= $list->getId() ?>">EMPRUNTER CE LIVRE</a>
            <?php } else { ?>
                <p class="livreIndispo">INDISPONIBLE</p>
            <?php } } ?>
            </div>
        </div>
    <?php } ?>
</div>