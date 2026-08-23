<?php

require_once __DIR__ . '/../config/Database.php';

class Aluno {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listarTodos() {
        $stmt = $this->db->prepare("SELECT * FROM alunos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function cadastrar($nome, $email, $telefone, $data_nascimento) {
        $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento) VALUES (:nome, :email, :telefone, :data_nascimento)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':data_nascimento' => $data_nascimento ?: null
        ]);
    }

    public function atualizar($id, $nome, $email, $telefone, $data_nascimento) {
        $sql = "UPDATE alunos SET nome = :nome, email = :email, telefone = :telefone, data_nascimento = :data_nascimento WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':data_nascimento' => $data_nascimento ?: null
        ]);
    }

    public function deletar($id) {
        $stmt = $this->db->prepare("DELETE FROM alunos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}