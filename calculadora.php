<?php
$resultado = '';
$numero1 = '';
$numero2 = '';
$operacion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero1 = isset($_POST['numero1']) ? floatval($_POST['numero1']) : 0;
    $numero2 = isset($_POST['numero2']) ? floatval($_POST['numero2']) : 0;
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';
    
    switch ($operacion) {
        case 'sumar':
            $resultado = $numero1 + $numero2;
            break;
        case 'restar':
            $resultado = $numero1 - $numero2;
            break;
        case 'multiplicar':
            $resultado = $numero1 * $numero2;
            break;
        case 'dividir':
            $resultado = $numero2 != 0 ? $numero1 / $numero2 : 'Error: División por cero';
            break;
        case 'potencia':
            $resultado = pow($numero1, $numero2);
            break;
        default:
            $resultado = 'Selecciona una operación';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
</head>
<body>
    <h1>Calculadora PHP</h1>
    <p>Realiza operaciones matemáticas básicas usando PHP.</p>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="numero1">Número 1:</label>
            <input type="number" step="any" name="numero1" id="numero1" value="<?= htmlspecialchars($numero1) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="numero2">Número 2:</label>
            <input type="number" step="any" name="numero2" id="numero2" value="<?= htmlspecialchars($numero2) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="operacion">Operación:</label>
            <select name="operacion" id="operacion" required>
                <option value="">Selecciona una operación</option>
                <option value="sumar" <?= $operacion === 'sumar' ? 'selected' : '' ?>>Sumar (+)</option>
                <option value="restar" <?= $operacion === 'restar' ? 'selected' : '' ?>>Restar (-)</option>
                <option value="multiplicar" <?= $operacion === 'multiplicar' ? 'selected' : '' ?>>Multiplicar (×)</option>
                <option value="dividir" <?= $operacion === 'dividir' ? 'selected' : '' ?>>Dividir (÷)</option>
                <option value="potencia" <?= $operacion === 'potencia' ? 'selected' : '' ?>>Potencia (^)</option>
            </select>
        </div>
        
        <button type="submit" class="btn">Calcular</button>
    </form>
    
    <?php if ($resultado !== ''): ?>
    <div class="result">
        <h3>Resultado:</h3>
        <p style="font-size: 1.5rem; font-weight: bold; color: #3498db;">
            <?= htmlspecialchars($resultado) ?>
        </p>
    </div>
    <?php endif; ?>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <h3>¿Ves cómo funciona PHP?</h3>
        <p>Este cálculo se realizó en el servidor usando PHP. El resultado se muestra instantáneamente sin recargar toda la página (si estás usando el sistema dinámico).</p>
        <p>PHP puede manejar cálculos mucho más complejos que estos - desde operaciones matemáticas avanzadas hasta procesamiento de grandes volúmenes de datos.</p>
    </div>
</body>
</html>
