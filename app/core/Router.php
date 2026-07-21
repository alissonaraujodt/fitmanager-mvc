<?php

class Router {
    private array $routes = [];

    public function __construct() {
        // Mapeamento de Rotas
        $this->addRoute('/', 'HomeController', 'index');
        $this->addRoute('/login', 'AuthController', 'login');
        $this->addRoute('/dashboard', 'HomeController', 'dashboard');
        $this->addRoute('/alunos', 'AlunoController', 'index');
    }

    private function addRoute(string $url, string $controller, string $action): void {
        $this->routes[$url] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function run(): void {
        $url = isset($_GET['url']) ? '/' . rtrim($_GET['url'], '/') : '/';

        if (array_key_exists($url, $this->routes)) {
            $controllerName = $this->routes[$url]['controller'];
            $actionName = $this->routes[$url]['action'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                    return;
                }
            }
        }

        // Rota não encontrada
        http_response_code(404);
        $core = new Controller();
        $core->view('errors/404');
    }
}
