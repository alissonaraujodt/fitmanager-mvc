<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController extends Controller {
    private $alunoModel;

    public function __construct() {
        $this->alunoModel = new Aluno();
    }

    // Renderiza a lista de alunos (Read)
    public function index() {
        $alunos = $this->alunoModel->listarTodos();
        $this->view('alunos/index', ['alunos' => $alunos]);
    }

    // Renderiza o formulário (Create)
    public function create() {
        $this->view('alunos/create');
    }

    // Processa a gravação dos dados no banco
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = $_POST['data_nascimento'] ?? null;

            if ($nome && $email) {
                $this->alunoModel->cadastrar($nome, $email, $telefone, $data_nascimento);
                header('Location: ' . BASE_URL . '/aluno/index');
                exit;
            }
        }
        
        $this->view('alunos/create', ['erro' => 'Preencha todos os campos obrigatórios.']);
    }
}