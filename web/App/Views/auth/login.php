<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <div class="row mt-3">
                <?php
                if (isset($_SESSION["mensagem"]) && $_SESSION["mensagem"] != "")
                    echo $_SESSION["mensagem"];
                ?>
            </div>

            <form action="/authenticate" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="text-center mt-3">
                <a href="#">Esqueceu sua senha?</a>
            </div>
        </div>
    </div>
</div>