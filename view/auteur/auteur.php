<?php
    $auteur = $response["data"]["list"];
    $countAll = $response["data"]["countAll"];
?>

<div id="pageTitle">
    <h1>AUTEURS&ensp;</h1>
    <p class="counterRound"><?= $countAll ?></p>
</div>

<div id="tableList">
    <table style="width: 100%;" class="txtL">
        <thead>
            <tr>
                <th>AUTEUR</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auteur as $list) { ?>
            <tr>
                <td><a class="blue-link" href="?ctrl=auteur&action=auteurDetails&id=<?= $list->getId() ?>"><?= $list->getFullName() ?></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>