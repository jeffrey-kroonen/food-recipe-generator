<?php

    namespace FoodRecipeGenerator\App\Http;

    /**
     *  Class Router.
     */
    class Router 
    {

        private static $routes = [];

        private static $pathNotFound = null;

        private static $methodNotAllowed = null;

    
        /**
         *  add
         * 
         *  @param string $expression   Path matching path in url.
         *  @param function $function   The callback function called when path name matches route.
         *  @param string $method   Defines the method used in the current route.
         *  @return void
         *  @access public
         */
        public static function add($expression, $function, $method = "get")
        {
            self::$routes[] = [
                "expression" => $expression,
                "function" => $function,
                "method" => $method
            ];
        }
    
        /**
         *  pathNotFound
         * 
         *  @param function $function   The callback function called when route is not found.
         *  @return void
         *  @access public
         */
        public static function pathNotFound($function)
        {
            self::$pathNotFound = $function;
        }
    
        /**
         *  methodNotAllowed
         * 
         *  @param function $function   The callback function called when method is not allowed.
         *  @return void
         *  @access public
         */
        public static function methodNotAllowed($function)
        {
            self::$methodNotAllowed = $function;
        }
    
        /**
         *  run
         * 
         *  @param string $basepath The basepath after the domain name.
         *  @return
         *  @access public
         */
        public static function run($basepath = "/") 
        {
    
            // Parse current url
            $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);//Parse Uri
        
            if(isset($parsedUrl["path"])){
                $path = $parsedUrl["path"];
            }else{
                $path = "/";
            }
        
            // Get current request method
            $method = $_SERVER["REQUEST_METHOD"];
        
            // Initialize $pathMatchFound
            $pathMatchFound = false;
        
            // Initialize $routeMatchFound
            $routeMatchFound = false;
        
            foreach (self::$routes as $route) {
        
                // If the method matches check the path
        
                // Add basepath to matching string
                if ($basepath != "" && $basepath != "/") {
                    $route["expression"] = "(" . rtrim($basepath, "/") . ")" . $route["expression"];
                }
        
                // Add "find string start" automatically
                $route["expression"] = "^".$route["expression"];
        
                // Add "find string end" automatically
                $route["expression"] = $route["expression"]."$";
        
                /** 
                 *  Debugger
                 * 
                 *  echo $route["expression"]."<br/>";
                 */
        
                // Check path match	
                if (preg_match("#" . $route["expression"] . "#", $path, $matches)) {

        
                // Check method match
                if(strtolower($method) == strtolower($route["method"])) {
                    
                    // Always remove first element. This contains the whole string
                    array_shift($matches);
        
                    if($basepath != "" && $basepath != "/") {
                        // Remove basepath
                        array_shift($matches);
                    }
        
                    call_user_func_array($route["function"], $matches);
        
                    $routeMatchFound = true;
        
                    // Do not check other routes
                    break;
                }
                }
            }
        
            // No matching route was found
            if(!$routeMatchFound) {
        
                // But a matching path exists
                if($pathMatchFound) {
                    header("HTTP/1.0 405 Method Not Allowed");
                    if(self::$methodNotAllowed) {
                        call_user_func_array(self::$methodNotAllowed, [$path, $method]);
                    }
                } else {
                    header("HTTP/1.0 404 Not Found");
                    if(self::$pathNotFound) {
                        call_user_func_array(self::$pathNotFound, [$path]);
                    }
                }

            }
    
        }
    
    }