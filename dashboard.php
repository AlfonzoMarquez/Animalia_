<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

requerirLogin();

// Top de veterinarias: mejor calificación primero, desempata por número de reseñas
$stmt = $pdo->query(
    'SELECT * FROM veterinarias
     ORDER BY calificacion DESC, total_resenas DESC
     LIMIT 6'
);
$veterinarias = $stmt->fetchAll();

/** Convierte 4.7 en ★★★★★ (llenas / vacías). */
function estrellas(float $nota): string
{
    $llenas = (int) round($nota);
    return str_repeat('★', $llenas) . str_repeat('☆', 5 - $llenas);
}

$titulo = 'Inicio';
require __DIR__ . '/includes/header.php';
?>

<section class="bienvenida">
    <h1>¡Bienvenido, <?= e($_SESSION['usuario_nombre']) ?>! 🐾</h1>
    <p>Estas son las veterinarias mejor calificadas de Animalia.</p>
</section>

<section>
    <h2 class="titulo-seccion"> Top veterinarias</h2>

    <div class="grid-vets">
        <?php foreach ($veterinarias as $i => $vet): ?>
            <article class="vet-card <?= $i === 0 ? 'vet-card-oro' : '' ?>">
                <span class="vet-puesto">#<?= $i + 1 ?></span>

                <h3><?= e($vet['nombre']) ?></h3>
                <p class="vet-ciudad"> <?= e($vet['ciudad']) ?> · <?= e($vet['direccion']) ?></p>

                <p class="vet-nota">
                    <span class="estrellas"><?= estrellas((float) $vet['calificacion']) ?></span>
                    <strong><?= number_format((float) $vet['calificacion'], 1) ?></strong>
                    <small>(<?= (int) $vet['total_resenas'] ?> reseñas)</small>
                </p>

                <p class="vet-especialidad"><?= e($vet['especialidad']) ?></p>
                <p class="vet-desc"><?= e($vet['descripcion']) ?></p>
                <p class="vet-tel"> <?= e($vet['telefono']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
