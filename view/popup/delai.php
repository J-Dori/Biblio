<?php 
    $msg = "";
    if (isset($_SESSION["messages"]["msg"]))
        $msg = $_SESSION["messages"]["msg"];
    unset($_SESSION["messages"]);
?>

<div class="modalWindow">
    <div id="messageModal" class="modal" style="<?= $msgDisplay ?>">
        <form class="modal-content" id="formDelai" method="POST" action="?ctrl=livre&action=emprunterLivre&id=<?= $_GET["id"]; ?>">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="modal-container">
                <h1>DELAI</h1>
                <p><?= $msg ?></p>
                <p>
                    <select id="delaiDays" name="delai" id="delai">
                    <?php foreach(range(1,15) as $nb) { ?>
                        <option value="<?= $nb ?>"><?= $nb ?></option>
                    <?php } ?>
                    </select>
                </p>
                <div class="clearfix">
                    <button id="closeMsg" type="button" class="closeMsg" name="closeMsg">Annuler</button>
                    <button id="greenBtt" type="submit" class="saveBtt">Confirmer</button>
                </div>
            </div>
        </form>
    </div>
</div>