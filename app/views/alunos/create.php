<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cadastrar Novo Aluno</h2>
        <a href="<?= BASE_URL ?>/aluno/index" class="btn btn-secondary">Voltar</a>
    </div>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/aluno/store" method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo *</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail *</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Aluno</button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>