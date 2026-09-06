<?php

class Router {
    public function run() {
        $url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
        $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

        // Obtém o nome base da rota em minúsculo
        $route = !empty($url[0]) ? strtolower($url[0]) : 'home';

        // Mapeamento de rotas no plural para o Controller no singular
        if ($route === 'alunos') {
            $controllerName = 'AlunoController';
        } else {
            $controllerName = ucfirst($route) . 'Controller';
        }
        
        // Define a Action (método)
        $action = isset($url[1]) && !empty($url[1]) ? $url[1] : 'index';

        // Caminho do arquivo do Controller
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();

            if (method_exists($controller, $action)) {
                unset($url[0], $url[1]);
                $params = array_values($url);
                
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }

        // Se a rota não existir, tenta chamar a página 404
        if (file_exists(__DIR__ . '/../controllers/HomeController.php')) {
            require_once __DIR__ . '/../controllers/HomeController.php';
            $controller = new HomeController();
            if (method_exists($controller, 'notFound')) {
                $controller->notFound();
                return;
            }
        }

        echo "Página 404 - Rota não encontrada.";
    }
}