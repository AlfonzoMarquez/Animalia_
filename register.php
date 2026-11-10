<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

soloInvitados();

$errores = [];
$nombre  = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirma = $_POST['confirmar'] ?? '';

    if ($nombre === '' || mb_strlen($nombre) < 2) {
        $errores[] = 'Escribe tu nombre (mínimo 2 caracteres).';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico no es válido.';
    }
    if (strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if ($password !== $confirma) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    // Verificar que el correo no exista
    if (!$errores) {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errores[] = 'Ya existe una cuenta con ese correo.';
        }
    }

    // Crear el usuario
    if (!$errores) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$nombre, $email, $hash]);

        header('Location: login.php?registrado=1');
        exit;
    }
}

$titulo = 'Crear cuenta';
require __DIR__ . '/includes/header.php';
?>

<section class="tarjeta-form">
    <h2>Crear cuenta</h2>

    <?php foreach ($errores as $error): ?>
        <div class="alerta alerta-error"><?= e($error) ?></div>
    <?php endforeach; ?>

    <form method="post" action="register.php" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($nombre) ?>" required>

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="<?= e($email) ?>" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmar">Confirmar contraseña</label>
        <input type="password" id="confirmar" name="confirmar" required>

        <button type="submit" class="btn btn-block">Registrarme</button>
    </form>

    <p class="texto-centro">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
