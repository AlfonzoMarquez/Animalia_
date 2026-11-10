<?php
/**
 * Cabecera común. Antes de incluirla, cada página puede definir $titulo.
 */
require_once __DIR__ . '/auth.php';
$titulo = $titulo ?? 'Animalia';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> | Animalia</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar">
    <a href="index.php" class="logo">🐾 Animalia</a>
    <nav>
        <?php if (estaLogueado()): ?>
            <span class="saludo">Hola, <?= e($_SESSION['usuario_nombre']) ?></span>
            <a href="dashboard.php">Inicio</a>
            <a href="logout.php" class="btn btn-secundario">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
            <a href="register.php" class="btn">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>
<main class="contenedor">
