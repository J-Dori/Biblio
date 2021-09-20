<?php 
    use App\Service\Session;
    $msg=""; $action=""; $user="";

    if (isset($_SESSION["messages"]["msg"]))
        $msg = $_SESSION["messages"]["msg"];
    unset($_SESSION["messages"]);

    if (!Session::isAnonymous()) {
        $user = Session::getUser();
        $action = "?ctrl=security&action=deleteMember&id=". Session::getUser()->getId();
    }
?>

<!-- Delete confirmation Modal -->
<div class="modalWindow">
    <div id="messageModal" class="modal" style="<?= $msgDisplay ?>">
        <form class="modal-content" id="formDelete" method="POST" action="<?= $action ?>">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="modal-container">
                <h1>SUPPRIMER</h1>
                <p><?= $msg ?></p>
                <div class="clearfix">
                    <button id="closeMsg" type="button" class="closeMsg" name="closeMsg">Annuler</button>
                    <button id="delOK" type="submit" class="delBtt">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>