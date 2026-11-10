<?php
require_once __DIR__ . '/includes/auth.php';

// Si ya inició sesión, lo mandamos directo al panel.
if (estaLogueado()) {
    header('Location: dashboard.php');
    exit;
}

$titulo = 'Bienvenido';
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <h1>Encuentra el mejor cuidado para tu mascota </h1>
    <p>Animalia reúne a las veterinarias mejor calificadas para que tu compañero peludo esté siempre en buenas manos.</p>
    <div class="hero-botones">
        <a href="register.php" class="btn btn-grande">Crear cuenta</a>
        <a href="login.php" class="btn btn-secundario btn-grande">Iniciar sesión</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
