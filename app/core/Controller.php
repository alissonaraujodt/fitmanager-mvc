<?php

class Controller {
    public function view(string $view, array $data = []): void {
        extract($data);
        
        $viewFile = "../app/views/{$view}.php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("A View '{$view}' não foi encontrada.");
        }
    }
}
