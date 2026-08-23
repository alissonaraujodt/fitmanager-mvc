<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController extends Controller {
    private $alunoModel;

    public function __construct() {
        Auth::check(); // Exige login para acessar qualquer ação de Aluno
        $this->alunoModel = new Aluno();
    }

    public function index() {
        $alunos = $this->alunoModel->listarTodos();
        $this->view('alunos/index', ['alunos' => $alunos]);
    }

    public function create() {
        $this->view('alunos/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = $_POST['data_nascimento'] ?? null;

            if ($nome && $email) {
                if ($this->alunoModel->cadastrar($nome, $email, $telefone, $data_nascimento)) {
                    $_SESSION['sucesso'] = "Aluno cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . '/aluno/index');
                    exit;
                }
            }
            $_SESSION['erro'] = "Preencha os campos obrigatórios corretamente.";
        }
        $this->view('alunos/create');
    }

    public function edit($id = null) {
        if (!$id) {
            header('Location: ' . BASE_URL . '/aluno/index');
            exit;
        }

        $aluno = $this->alunoModel->buscarPorId($id);
        if (!$aluno) {
            $_SESSION['erro'] = "Aluno não encontrado.";
            header('Location: ' . BASE_URL . '/aluno/index');
            exit;
        }

        $this->view('alunos/edit', ['aluno' => $aluno]);
    }

    public function update($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = $_POST['data_nascimento'] ?? null;

            if ($nome && $email) {
                if ($this->alunoModel->atualizar($id, $nome, $email, $telefone, $data_nascimento)) {
                    $_SESSION['sucesso'] = "Dados do aluno atualizados com sucesso!";
                    header('Location: ' . BASE_URL . '/aluno/index');
                    exit;
                }
            }
            $_SESSION['erro'] = "Falha ao atualizar dados. Verifique os campos.";
        }
        header('Location: ' . BASE_URL . '/aluno/edit/' . $id);
        exit;
    }

    public function delete($id = null) {
        Auth::checkRole(['admin']); // Apenas perfil ADMIN pode excluir

        if ($id && $this->alunoModel->deletar($id)) {
            $_SESSION['sucesso'] = "Aluno removido com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao tentar remover o aluno.";
        }
        header('Location: ' . BASE_URL . '/aluno/index');
        exit;
    }
}