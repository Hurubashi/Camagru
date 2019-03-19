<?php
/**
 * Created by PhpStorm.
 * User: mrybak
 * Date: 17.03.2019
 * Time: 17:22
 */

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    // Returns request string
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     *
     */
    public function run()
    {
        // Get request string
        $uri = $this->getURI();
        if ($uri == NULL) {
            include_once(ROOT . "/views/Index.php");
            return;
        }
        // Check if routes.php have this request
        foreach ($this->routes as $uriPattern => $path) {

            // If it is, select corresponding controller and action
            // ALLERT!!!! This need to be fixed!
            if (preg_match("~^$uriPattern\b~", $uri)) {

                $segments = explode('/', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));
                echo '<br>Class: ' . $controllerName;
                echo '<br>Method: ' . $actionName;


                // Include file of controller class
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object, coll method (i.e. action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    return;
                }
            }

        }
        include_once(ROOT . "/views/404_page.html");
        echo "PICHAL'KA!!!! 404 page not found ";

    }
}

?>