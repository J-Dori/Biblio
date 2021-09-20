<?php
    use App\Service\Session;
    $isAdmin = (Session::isRoleUser("ROLE_ADMIN")) ? true : false;
    $active = ""; //navBar $active Button 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>BIBLIO</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;600&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>navBarBurger.css">
    <title></title>
</head>
<body>
    
    <div class="navBarResp txtC">
        <?php include "view/home/navBarBurger.php" ?>
    </div>
    <div id="navBar">
        <div id="navBarLeft">
            <?php if(isset($_GET["ctrl"])) $active = $_GET["ctrl"]; ?>
            <a class="logo" href="?ctrl=home&action=index"><img src="public/images/logo.png" alt="Logo"></a>
            <a href="?ctrl=livre&action=index" class="<?= ($active == "livre") ? "navActive" : ""; ?>">LIVRES</a>
            <a href="?ctrl=auteur&action=index" class="<?= ($active == "auteur") ? "navActive" : ""; ?>">AUTEURS</a>
            <?php if ($isAdmin) { ?>
                <a href="?ctrl=emprunt&action=index" class="<?= ($active == "emprunt") ? "navActive" : ""; ?>>">EMPRUNTS</a>
            <?php } ?>
        </div>
        <div id="navBarRight">
            <?php if (Session::isAnonymous()) { ?>
            <div class="navBarRightN">
                <a href="?ctrl=security&action=register">S'ENREGISTRER</a>
                <a href="?ctrl=security&action=login">SE CONNECTER</a>
            </div>
            <div class="navBarRightR">
                <a href="?ctrl=security&action=login"><i class="fas fa-sign-in-alt"></i></a>
            </div>
            <?php } ?>
            <?php if (!Session::isAnonymous()) { ?>
            <div class="navBarRightN">
                <a href="?ctrl=user&action=profile" class="<?= ($active == "user") ? "navActive" : ""; ?>">PROFILE (<?= Session::getUser()->getPrenom(); ?>)</a>
                <a href="?ctrl=security&action=logout">DÉCONNECTER</a>
            </div>
            <div class="navBarRightR">
                <a href="?ctrl=user&action=profile" class="navBarRightResp"><i class="fas fa-user"></i></a>
                <a href="?ctrl=security&action=logout" class="navBarRightResp"><i class="fas fa-sign-out-alt"></i></a>
            </div>
            <?php } ?>
        </div>
    </div>

    <div id="banner"></div>

    <main>
        <?= $content;
            $msgDisplay = "display:none";
            $msgType = "";
            if (isset($_SESSION["messages"])) {
                $msgType = $_SESSION["messages"]["type"];
                $msgDisplay = "display:block";
            } 
            if ($msgType != "") include "view/popup/$msgType.php" ?>
    </main>
    
    <script src="public/js/script.js"></script>
    
</body>
</html> 