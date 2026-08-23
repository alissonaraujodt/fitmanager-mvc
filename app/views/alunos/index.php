<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listagem de Alunos</h2>
        <a href="<?= BASE_URL ?>/aluno/create" class="btn btn-success">+ Novo Aluno</a>
    </div>

    <div class="card shadow-sm">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Data Nasc.</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alunos)): ?>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?= $aluno['id'] ?></td>
                            <td><?= htmlspecialchars($aluno['nome']) ?></td>
                            <td><?= htmlspecialchars($aluno['email']) ?></td>
                            <td><?= htmlspecialchars($aluno['telefone'] ?? '-') ?></td>
                            <td><?= $aluno['data_nascimento'] ? date('d/m/Y', strtotime($aluno['data_nascimento'])) : '-' ?></td>
                            <td class="text-center">
                                <a href="<?= BASE_URL ?>/aluno/edit/<?= $aluno['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <?php if ($_SESSION['user_perfil'] === 'admin'): ?>
                                    <a href="<?= BASE_URL ?>/aluno/delete/<?= $aluno['id'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Tem certeza que deseja excluir este aluno?');">
                                        Excluir
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-3">Nenhum aluno cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>