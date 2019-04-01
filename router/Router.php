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
        $routesPath = ROOT.'/router/routes.php';
        $this->routes = include($routesPath);
    }

    // Returns request string
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $internalRoute = trim($_SERVER['REQUEST_URI'], '/');
            if ($internalRoute == NULL) {
                return "main";
            } else {
                return $internalRoute;
            }
        }
    }

    /**
     *
     */
    public function run()
    {
        // Get request string
        $uri = $this->getURI();
        // Check if routes.php have this request
        foreach ($this->routes as $uriPattern => $path) {
            // If it is, select corresponding controller and action
            if (preg_match("~^$uriPattern$~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));
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

    }
}

?>