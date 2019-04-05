<?php

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

    public function run()
    {
        // Get request string
        $uri = $this->getURI();
        // Check if routes.php have this request
        foreach ($this->routes as $uriPattern => $path) {
            // If it is, select corresponding controller and action
            if (preg_match("~^$uriPattern($|\?)~", $uri)) {
                $segments = explode('/', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . array_shift($segments);
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
        // Page not found
        include_once(ROOT . '/controllers/ErrorPageController.php');
        $controllerObject2 = new ErrorPageController;
        $controllerObject2->actionError404();
    }
}

?>
