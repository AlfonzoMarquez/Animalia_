<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

soloInvitados();

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, nombre, password FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario['password'])) {
        session_regenerate_id(true); // evita fijación de sesión
        $_SESSION['usuario_id']     = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        header('Location: dashboard.php');
        exit;
    }

    $error = 'Correo o contraseña incorrectos.';
}

$titulo = 'Iniciar sesión';
require __DIR__ . '/includes/header.php';
?>

<section class="tarjeta-form">
    <h2>Iniciar sesión</h2>

    <?php if (isset($_GET['registrado'])): ?>
        <div class="alerta alerta-ok">¡Cuenta creada! Ya puedes iniciar sesión.</div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alerta alerta-error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="<?= e($email) ?>" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-block">Entrar</button>
    </form>

    <p class="texto-centro">¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
