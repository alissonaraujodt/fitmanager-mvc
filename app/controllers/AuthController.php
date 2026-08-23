<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController extends Controller {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/aluno/index');
            exit;
        }
        $this->view('auth/login');
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            if (!$email || empty($senha)) {
                $_SESSION['erro'] = "Preencha todos os campos corretamente.";
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

            $user = $this->usuarioModel->buscarPorEmail($email);

            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome'];
                $_SESSION['user_perfil'] = $user['perfil'];
                $_SESSION['sucesso'] = "Bem-vindo(a), " . $user['nome'] . "!";
                
                header('Location: ' . BASE_URL . '/aluno/index');
                exit;
            } else {
                $_SESSION['erro'] = "E-mail ou senha inválidos.";
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        session_start();
        $_SESSION['sucesso'] = "Sessão encerrada com sucesso.";
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}