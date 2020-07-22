<?php

    /**
     * Require files.
     */
    require_once dirname(__DIR__) . "/bootstrap.php";

    /**
     * Use classes.
     */
    use FoodRecipeGenerator\App\Http\Router;

    /**
     * Initialize page[].
     */
    $page = [];

    Router::add("/", FoodRecipeGenerator\App\Http\Controller\HomeController::index(["title" => "Home"]));