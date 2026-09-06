<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <span><?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <span><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">FitManager Login</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/auth/authenticate" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="usuario@exemplo.com" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" required placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>