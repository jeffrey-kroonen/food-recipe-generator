<?php

    /**
     * Application
     */
    define("APPNAME", "Food Recipe Generator");
    define("VERSION", "0.0.1");
    define("DOCUMENT_ROOT", __DIR__);
    define("WEBSITE_ROOT", "/food-recipe-generator/public");
    define("URL", "http://localhost" . WEBSITE_ROOT);

    /**
     * Layout
     */
    define("HEADER", DOCUMENT_ROOT . "/resources/layouts/header.php");
    define("FOOTER", DOCUMENT_ROOT . "/resources/layouts/footer.php");

    /**
     * Require files.
     */
    require_once "vendor/autoload.php";

    /**
     * JavaScript
     */
    echo "<script type='text/javascript'>var WEBSITE_ROOT = '" . WEBSITE_ROOT . "'</script>";