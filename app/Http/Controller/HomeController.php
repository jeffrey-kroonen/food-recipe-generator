<?php

    namespace FoodRecipeGenerator\App\Http\Controller;

    /**
     * Class HomeController.
     */
    class HomeController
    {
        public static function index($page)
        {
            include dirname(__DIR__, 3) . "/public/generate.php";
        }
    }