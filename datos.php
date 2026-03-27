<?php
// Datos de ejemplo que podrían venir de una base de datos
$usuarios = [
    ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@email.com', 'edad' => 28, 'ciudad' => 'Madrid'],
    ['id' => 2, 'nombre' => 'María García', 'email' => 'maria@email.com', 'edad' => 34, 'ciudad' => 'Barcelona'],
    ['id' => 3, 'nombre' => 'Carlos López', 'email' => 'carlos@email.com', 'edad' => 25, 'ciudad' => 'Valencia'],
    ['id' => 4, 'nombre' => 'Ana Martínez', 'email' => 'ana@email.com', 'edad' => 31, 'ciudad' => 'Sevilla'],
    ['id' => 5, 'nombre' => 'Luis Rodríguez', 'email' => 'luis@email.com', 'edad' => 29, 'ciudad' => 'Bilbao']
];

// Procesar formulario de búsqueda
$busqueda = '';
$resultados = $usuarios;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['busqueda'])) {
    $busqueda = strtolower(trim($_POST['busqueda']));
    if (!empty($busqueda)) {
        $resultados = array_filter($usuarios, function($usuario) use ($busqueda) {
            return strpos(strtolower($usuario['nombre']), $busqueda) !== false ||
                   strpos(strtolower($usuario['email']), $busqueda) !== false ||
                   strpos(strtolower($usuario['ciudad']), $busqueda) !== false;
        });
    }
}

// Estadísticas
$totalUsuarios = count($usuarios);
$edadPromedio = array_sum(array_column($usuarios, 'edad')) / $totalUsuarios;
$ciudades = array_unique(array_column($usuarios, 'ciudad'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Dinámicos PHP</title>
</head>
<body>
    <h1>Datos Dinámicos con PHP</h1>
    <p>Ejemplo de cómo PHP puede manejar datos dinámicamente.</p>
    
    <!-- Estadísticas -->
    <div style="background-color: #ecf0f1; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
        <h3>Estadísticas Generadas por PHP</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
            <div style="text-align: center; padding: 15px; background: white; border-radius: 5px;">
                <div style="font-size: 2rem; font-weight: bold; color: #3498db;"><?= $totalUsuarios ?></div>
                <div>Total Usuarios</div>
            </div>
            <div style="text-align: center; padding: 15px; background: white; border-radius: 5px;">
                <div style="font-size: 2rem; font-weight: bold; color: #27ae60;"><?= number_format($edadPromedio, 1) ?></div>
                <div>Edad Promedio</div>
            </div>
            <div style="text-align: center; padding: 15px; background: white; border-radius: 5px;">
                <div style="font-size: 2rem; font-weight: bold; color: #e74c3c;"><?= count($ciudades) ?></div>
                <div>Ciudades</div>
            </div>
        </div>
    </div>
    
    <!-- Formulario de búsqueda -->
    <form method="POST" action="" style="margin-bottom: 30px;">
        <div class="form-group">
            <label for="busqueda">Buscar usuarios:</label>
            <input type="text" id="busqueda" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Buscar por nombre, email o ciudad...">
        </div>
        <button type="submit" class="btn">Buscar</button>
    </form>
    
    <!-- Tabla de resultados -->
    <h3>Lista de Usuarios <?= !empty($busqueda) ? "(Resultados: " . count($resultados) . ")" : "" ?></h3>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #3498db; color: white;">
                <th style="padding: 12px; text-align: left;">ID</th>
                <th style="padding: 12px; text-align: left;">Nombre</th>
                <th style="padding: 12px; text-align: left;">Email</th>
                <th style="padding: 12px; text-align: left;">Edad</th>
                <th style="padding: 12px; text-align: left;">Ciudad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $usuario): ?>
            <tr style="border-bottom: 1px solid #ddd; <?= $usuario['edad'] > 30 ? 'background-color: #f8f9fa;' : '' ?>">
                <td style="padding: 12px;"><?= $usuario['id'] ?></td>
                <td style="padding: 12px; font-weight: bold;"><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td style="padding: 12px;"><?= htmlspecialchars($usuario['email']) ?></td>
                <td style="padding: 12px;">
                    <span style="background-color: <?= $usuario['edad'] < 25 ? '#e74c3c' : ($usuario['edad'] < 30 ? '#f39c12' : '#27ae60') ?>; color: white; padding: 4px 8px; border-radius: 3px;">
                        <?= $usuario['edad'] ?> años
                    </span>
                </td>
                <td style="padding: 12px;"><?= htmlspecialchars($usuario['ciudad']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if (empty($resultados)): ?>
    <div class="result">
        <p>No se encontraron resultados para "<strong><?= htmlspecialchars($busqueda) ?></strong>"</p>
    </div>
    <?php endif; ?>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <h3>¿Qué hace PHP aquí?</h3>
        <ul>
            <li>✅ Genera estadísticas automáticamente (promedio de edad, totales)</li>
            <li>✅ Filtra datos según búsqueda del usuario</li>
            <li>✅ Aplica lógica condicional (colores según edad)</li>
            <li>✅ Maneja arrays y bucles eficientemente</li>
            <li>✅ Escapa datos para seguridad (htmlspecialchars)</li>
        </ul>
    </div>
</body>
</html>
