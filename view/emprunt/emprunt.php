<?php
    $emprunt = $response["data"]["list"];
    $countAll = count($response["data"]["list"]);
?>

<div id="pageTitle">
    <h1>EMPRUNTS&ensp;</h1>
    <p class="counterRound"><?= $countAll ?></p>
</div>

<div id="tableList">
    <table style="width: 100%;" class="txtL">
        <thead>
            <tr>
                <th class="txtL" >LIVRE</th>
                <th class="txtL" >MEMBRE</th>
                <th class="txtC" style="min-width: 110px">DATE EMPRUNT</th>
                <th class="txtC" style="min-width: 110px">DATE RETOUR</th>
                <th class="txtC" style="min-width: 95px">RETARD ?</th>
                <th class="txtC" >RENDU DU LIVRE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emprunt as $emp) { ?>
                <tr>
                    <td class="txtL" style="width: 175px"><?= $emp->getExemplaire()->getLivre()->getTitre() ?></td>
                    <td><a class="blue-link" href="?ctrl=user&action=userDetails&id=<?= $emp->getUser()->getId() ?>"><?= $emp->getUser()->getFullName() ?></a></td>
                    <td class="txtC" style="min-width: 110px"><?= $emp->getDateEmprunt() ?></td>
                    <td class="txtC" style="min-width: 110px"><?= $emp->getDateRetour() ?></td>
                    <td class="txtC" style="min-width: 95px">
                        <?php if ($emp->getRetard() != null) { ?>
                        <p class="livreIndispo"><?php echo $emp->getRetard(); if ($emp->getRetard() == 1) echo " JOUR"; else echo " JOURS"; ?></p></td>
                        <?php } ?>
                    <td class="txtC"><a class="greenBtt boxShaddow" href="?ctrl=emprunt&action=rendreLivre&id=<?= $emp->getId() ?>">LIVRE RENDU</a></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>