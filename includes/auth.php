<?php
/**
 * Funciones de sesión compartidas por todas las páginas.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function estaLogueado(): bool
{
    return isset($_SESSION['usuario_id']);
}

/** Redirige al login si no hay sesión iniciada. */
function requerirLogin(): void
{
    if (!estaLogueado()) {
        header('Location: login.php');
        exit;
    }
}

/** Redirige al dashboard si ya hay sesión (para login/registro). */
function soloInvitados(): void
{
    if (estaLogueado()) {
        header('Location: dashboard.php');
        exit;
    }
}

/** Escapa texto para imprimirlo de forma segura en HTML. */
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
