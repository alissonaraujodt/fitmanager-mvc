<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';

class HomeController extends Controller {
    public function index() {
        Auth::check();
        header('Location: ' . BASE_URL . '/aluno/index');
        exit;
    }
}