<?php
    $auteur = $response["data"]["auteur"]; //Table: Auteur
    $list = $response["data"]["list"]; //Table: Livre
?>

<div id="pageTitle">
    <h1><?= $auteur->getFullName() ?></h1>
</div>

<div id="auteurDetails-table">
    <table>
        <thead>
            <tr>
                <td><h2>BIBLIOGRAPHIE</h2></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $db) { ?>
            <tr>
                <td><a class="blue-link" href="?ctrl=livre&action=livreDetails&id=<?= $db->getId() ?>"><?= $db->getTitre() ?></a>&emsp;(<?= $db->getAnnee() ?>)</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>