<?php

class AlunoController extends Controller {
    public function index(): void {
        $data = ['titulo' => 'Gerenciamento de Alunos'];
        $this->view('alunos/index', $data);
    }
}
