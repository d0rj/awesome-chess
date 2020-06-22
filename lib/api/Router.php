<?php 

require_once __DIR__."/IRouteHandler.php";


class Router 
{
    private array $handlers = [];


    public function AddRoute(string $route, IRouteHandler &$handler)
    {
       $this->handlers[$route] = $handler;
    }

    
    public function Work(): void 
    {
        header('Content-type: json/application');
        
        $q = $_GET['q'];
        $params = explode('/', $q);

        $handler = $params[0];
        $params = array_slice($params, 1);

        $method = $_SERVER['REQUEST_METHOD'];
        call_user_func(array($this->handlers[$handler], 'On'.$method), $params);
    }
}
