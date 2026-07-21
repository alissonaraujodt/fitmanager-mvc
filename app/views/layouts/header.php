<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'FitManager MVC'; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1a365d; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        header h2 { margin: 0; font-size: 20px; }
        nav a { color: #e2e8f0; margin-left: 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #ffffff; text-decoration: underline; }
        .container { padding: 30px 20px; max-width: 1000px; margin: 0 auto; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .btn { display: inline-block; background: #2b6cb0; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <h2>FitManager MVC</h2>
        <nav>
            <a href="<?= BASE_URL; ?>/">Início</a>
            <a href="<?= BASE_URL; ?>/login">Login</a>
            <a href="<?= BASE_URL; ?>/dashboard">Dashboard</a>
            <a href="<?= BASE_URL; ?>/alunos">Alunos</a>
        </nav>
    </header>
    <div class="container">
