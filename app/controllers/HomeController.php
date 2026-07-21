<?php

class HomeController extends Controller {
    public function index(): void {
        $data = ['titulo' => 'Página Inicial - FitManager'];
        $this->view('home/index', $data);
    }

    public function dashboard(): void {
        $data = ['titulo' => 'Dashboard Administrativo'];
        $this->view('home/dashboard', $data);
    }
}
