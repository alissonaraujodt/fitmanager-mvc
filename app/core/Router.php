<?php

class Router {
    public function run() {
        $url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
        $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

        // Define o Controller
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        
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