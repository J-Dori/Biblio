<?php
    use App\Service\Session;
    $isAdmin = (Session::isRoleUser("ROLE_ADMIN")) ? true : false;
?>

<div class="navResp">
  <a class="logo" href="?ctrl=home&action=index"><img src="public/images/logo.png" alt="Logo"></a>
  <span id="hamOpen" alt="Open"><i class="fas fa-bars fa-2x hamOpen" onclick="hamOpen()" ></i></span>
  <span id="hamClose" alt="Close"><i class="fas fa-times hamClose" onclick="hamClose()" ></i></span>

  <!-- (C) MENU ITEMS -->
  <div id="navRespBackground">
    <div class="navResp-links">
      <a href="?ctrl=livre&action=index">LIVRES</a>
      <a href="?ctrl=auteur&action=index">AUTEURS</a>
      <?php if ($isAdmin) { ?>
          <a href="?ctrl=emprunt&action=index">EMPRUNTS</a>
      <?php } ?>

      <hr>

      <?php if (Session::isAnonymous()) { ?>
      <a href="?ctrl=security&action=register">S'ENREGISTRER</a>
      <a href="?ctrl=security&action=login">SE CONNECTER</a>
      <?php } ?>

      <?php if (!Session::isAnonymous()) { ?>
      <a href="?ctrl=user&action=profile">PROFILE (<?= Session::getUser()->getPrenom(); ?>)</a>
      <a href="?ctrl=security&action=logout">DÉCONNECTER</a>
      <?php } ?>
    </div>
  </div>
</div>

<script>

</script>