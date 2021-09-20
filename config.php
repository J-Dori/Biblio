<?php
    date_default_timezone_set('Europe/Paris');
    Locale::setDefault('fr_FR.utf-8');

    define("SECRET_APP", "HyrAuKuMatta");

    define("DB_HOST", "localhost");
    define("DB_NAME", "bibliomvc");
    define("DB_USER", "root");
    define("DB_PASS", "");

    define("DEFAULT_CTRL", "home");
    define("DEFAULT_ACTION", "index");

    define("CSS_PATH", "public/css/");
    define("IMG_PATH", "public/img/");
    define("JS_PATH", "public/js/");
    define("VIEW_PATH", "view/");