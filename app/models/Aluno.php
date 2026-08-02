<?php

require_once __DIR__ . '/../config/Database.php';

class Aluno {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // READ: Buscar todos os alunos
    public function listarTodos() {
        $stmt = $this->db->prepare("SELECT * FROM alunos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // CREATE: Cadastrar um novo aluno
    public function cadastrar($nome, $email, $telefone, $data_nascimento) {
        $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento) VALUES (:nome, :email, :telefone, :data_nascimento)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':data_nascimento' => $data_nascimento
        ]);
    }
}