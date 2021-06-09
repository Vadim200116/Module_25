<?php
class Route
{
    function __construct()
    {
    }
    public static function start()
    {
        $title = 'main';
        $actionName = 'default';

        $routes = $_SERVER['REQUEST_URI'];
        $routes = trim($routes, '/');
        $routes = explode('/', $routes);


        if (isset($routes[1]) && !empty($routes[1])) {
            $title = strtolower($routes[1]);
            if (isset($routes[2])) {
                $actionName = strtolower($routes[2]);
            }
        }

        $modelName = 'model_' . $title;
        $controllerName = 'controller_' . $title;
        $actionName = 'action_' . $actionName;

        $modelFilePath = 'application/models/' . $modelName . '.php';
        if (file_exists($modelFilePath)) {
            include $modelFilePath;
        }
        $controllerFilePath = 'application/controllers/' . $controllerName . '.php';
        if (file_exists($controllerFilePath)) {
            include $controllerFilePath;
        } else {
            Route::Error404();
            return;
        }

        $controller = new $controllerName;
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            Route::Error404();
            return;
        }
    }

    public static function Error404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . $host . '404');
    }
}
