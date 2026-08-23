<?php

class Auth {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['erro'] = "Acesso restrito! Faça login para continuar.";
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public static function checkRole($roles = []) {
        self::check();
        if (!in_array($_SESSION['user_perfil'], $roles)) {
            $_SESSION['erro'] = "Você não tem permissão para realizar esta ação.";
            header('Location: ' . BASE_URL . '/aluno/index');
            exit;
        }
    }

    public static function user() {
        return $_SESSION['user_nome'] ?? null;
    }

    public static function role() {
        return $_SESSION['user_perfil'] ?? null;
    }
}