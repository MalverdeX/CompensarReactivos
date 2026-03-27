<?php
// Función para calcular estadísticas avanzadas
function calcularEstadisticas($datos) {
    $n = count($datos);
    if ($n == 0) return null;
    
    $media = array_sum($datos) / $n;
    
    // Varianza y desviación estándar
    $varianza = 0;
    foreach ($datos as $valor) {
        $varianza += pow($valor - $media, 2);
    }
    $varianza /= $n;
    $desviacionEstandar = sqrt($varianza);
    
    // Mediana
    sort($datos);
    $mediana = $n % 2 == 0 ? ($datos[$n/2 - 1] + $datos[$n/2]) / 2 : $datos[floor($n/2)];
    
    return [
        'media' => $media,
        'mediana' => $mediana,
        'desviacion' => $desviacionEstandar,
        'min' => min($datos),
        'max' => max($datos),
        'varianza' => $varianza
    ];
}

// Función para calcular regresión lineal
function regresionLineal($x, $y) {
    $n = count($x);
    if ($n != count($y) || $n == 0) return null;
    
    $sumX = array_sum($x);
    $sumY = array_sum($y);
    $sumXY = 0;
    $sumX2 = 0;
    
    for ($i = 0; $i < $n; $i++) {
        $sumXY += $x[$i] * $y[$i];
        $sumX2 += $x[$i] * $x[$i];
    }
    
    $pendiente = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
    $intercepto = ($sumY - $pendiente * $sumX) / $n;
    
    // Calcular R²
    $yPromedio = $sumY / $n;
    $sst = 0; // Suma total de cuadrados
    $ssr = 0; // Suma de regresión de cuadrados
    
    for ($i = 0; $i < $n; $i++) {
        $yPredicho = $pendiente * $x[$i] + $intercepto;
        $sst += pow($y[$i] - $yPromedio, 2);
        $ssr += pow($yPredicho - $yPromedio, 2);
    }
    
    $r2 = $sst != 0 ? $ssr / $sst : 0;
    
    return [
        'pendiente' => $pendiente,
        'intercepto' => $intercepto,
        'r2' => $r2,
        'ecuacion' => "y = " . number_format($pendiente, 4) . "x + " . number_format($intercepto, 4)
    ];
}

// Procesar formulario
$resultados = [];
$datosFormulario = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipo_calculo'])) {
        $tipo = $_POST['tipo_calculo'];
        
        switch ($tipo) {
            case 'estadisticas':
                if (!empty($_POST['datos'])) {
                    $datos = array_map('floatval', explode(',', $_POST['datos']));
                    $datos = array_filter($datos);
                    if (!empty($datos)) {
                        $resultados['estadisticas'] = calcularEstadisticas($datos);
                        $datosFormulario['datos'] = $_POST['datos'];
                    }
                }
                break;
                
            case 'regresion':
                if (!empty($_POST['datos_x']) && !empty($_POST['datos_y'])) {
                    $x = array_map('floatval', explode(',', $_POST['datos_x']));
                    $y = array_map('floatval', explode(',', $_POST['datos_y']));
                    $x = array_filter($x);
                    $y = array_filter($y);
                    
                    if (count($x) == count($y) && !empty($x)) {
                        $resultados['regresion'] = regresionLineal($x, $y);
                        $datosFormulario['datos_x'] = $_POST['datos_x'];
                        $datosFormulario['datos_y'] = $_POST['datos_y'];
                    }
                }
                break;
                
            case 'matriz':
                if (!empty($_POST['matriz_a']) && !empty($_POST['matriz_b'])) {
                    // Parsear matrices (simplificado)
                    $filasA = explode(';', $_POST['matriz_a']);
                    $matrizA = [];
                    foreach ($filasA as $fila) {
                        $matrizA[] = array_map('floatval', explode(',', trim($fila)));
                    }
                    
                    $filasB = explode(';', $_POST['matriz_b']);
                    $matrizB = [];
                    foreach ($filasB as $fila) {
                        $matrizB[] = array_map('floatval', explode(',', trim($fila)));
                    }
                    
                    // Multiplicación de matrices (básica)
                    if (count($matrizA[0]) == count($matrizB)) {
                        $resultado = [];
                        for ($i = 0; $i < count($matrizA); $i++) {
                            $fila = [];
                            for ($j = 0; $j < count($matrizB[0]); $j++) {
                                $suma = 0;
                                for ($k = 0; $k < count($matrizB); $k++) {
                                    $suma += $matrizA[$i][$k] * $matrizB[$k][$j];
                                }
                                $fila[] = $suma;
                            }
                            $resultado[] = $fila;
                        }
                        $resultados['matriz'] = $resultado;
                        $datosFormulario['matriz_a'] = $_POST['matriz_a'];
                        $datosFormulario['matriz_b'] = $_POST['matriz_b'];
                    }
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculos Complejos con PHP</title>
</head>
<body>
    <h1>Cálculos Complejos con PHP</h1>
    <p>PHP es excelente para cálculos matemáticos avanzados. Aquí hay algunos ejemplos:</p>
    
    <div style="background-color: #e8f4f8; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
        <h3>🔬 Capacidades matemáticas de PHP</h3>
        <ul>
            <li>✅ Funciones trigonométricas (sin, cos, tan, etc.)</li>
            <li>✅ Logaritmos y exponenciales</li>
            <li>✅ Estadísticas avanzadas</li>
            <li>✅ Álgebra lineal</li>
            <li>✅ Cálculo numérico</li>
            <li>✅ Procesamiento de grandes volúmenes de datos</li>
        </ul>
    </div>
    
    <!-- Pestañas de cálculos -->
    <div style="margin-bottom: 30px;">
        <button onclick="showTab('estadisticas')" class="btn" style="margin-right: 10px;">Estadísticas</button>
        <button onclick="showTab('regresion')" class="btn" style="margin-right: 10px;">Regresión Lineal</button>
        <button onclick="showTab('matriz')" class="btn">Multiplicación de Matrices</button>
    </div>
    
    <!-- Tab de Estadísticas -->
    <div id="estadisticas-tab" class="tab-content">
        <h3>📊 Estadísticas Descriptivas</h3>
        <form method="POST">
            <input type="hidden" name="tipo_calculo" value="estadisticas">
            
            <div class="form-group">
                <label for="datos">Datos (separados por comas):</label>
                <input type="text" name="datos" id="datos" 
                       value="<?= htmlspecialchars($datosFormulario['datos'] ?? '12, 15, 18, 20, 22, 25, 28, 30, 32, 35') ?>" 
                       placeholder="Ej: 10, 20, 30, 40, 50">
            </div>
            
            <button type="submit" class="btn">Calcular Estadísticas</button>
        </form>
        
        <?php if (isset($resultados['estadisticas'])): ?>
        <div class="result">
            <h4>Resultados Estadísticos:</h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Media:</strong> <?= number_format($resultados['estadisticas']['media'], 2) ?>
                </div>
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Mediana:</strong> <?= number_format($resultados['estadisticas']['mediana'], 2) ?>
                </div>
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Desv. Estándar:</strong> <?= number_format($resultados['estadisticas']['desviacion'], 2) ?>
                </div>
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Mínimo:</strong> <?= number_format($resultados['estadisticas']['min'], 2) ?>
                </div>
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Máximo:</strong> <?= number_format($resultados['estadisticas']['max'], 2) ?>
                </div>
                <div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Varianza:</strong> <?= number_format($resultados['estadisticas']['varianza'], 2) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Tab de Regresión -->
    <div id="regresion-tab" class="tab-content" style="display: none;">
        <h3>📈 Regresión Lineal</h3>
        <form method="POST">
            <input type="hidden" name="tipo_calculo" value="regresion">
            
            <div class="form-group">
                <label for="datos_x">Valores X (separados por comas):</label>
                <input type="text" name="datos_x" id="datos_x" 
                       value="<?= htmlspecialchars($datosFormulario['datos_x'] ?? '1, 2, 3, 4, 5, 6, 7, 8') ?>" 
                       placeholder="Ej: 1, 2, 3, 4, 5">
            </div>
            
            <div class="form-group">
                <label for="datos_y">Valores Y (separados por comas):</label>
                <input type="text" name="datos_y" id="datos_y" 
                       value="<?= htmlspecialchars($datosFormulario['datos_y'] ?? '2, 4, 5, 4, 5, 7, 8, 10') ?>" 
                       placeholder="Ej: 2, 4, 6, 8, 10">
            </div>
            
            <button type="submit" class="btn">Calcular Regresión</button>
        </form>
        
        <?php if (isset($resultados['regresion'])): ?>
        <div class="result">
            <h4>Resultados de Regresión Lineal:</h4>
            <p><strong>Ecuación:</strong> <?= $resultados['regresion']['ecuacion'] ?></p>
            <p><strong>Pendiente (m):</strong> <?= number_format($resultados['regresion']['pendiente'], 4) ?></p>
            <p><strong>Intercepto (b):</strong> <?= number_format($resultados['regresion']['intercepto'], 4) ?></p>
            <p><strong>Coeficiente R²:</strong> <?= number_format($resultados['regresion']['r2'], 4) ?></p>
            <p style="margin-top: 10px; font-size: 0.9rem; color: #666;">
                R² indica qué tan bien se ajusta la línea a los datos (0 = mal ajuste, 1 = ajuste perfecto)
            </p>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Tab de Matrices -->
    <div id="matriz-tab" class="tab-content" style="display: none;">
        <h3>🔢 Multiplicación de Matrices</h3>
        <form method="POST">
            <input type="hidden" name="tipo_calculo" value="matriz">
            
            <div class="form-group">
                <label for="matriz_a">Matriz A (filas separadas por ;, columnas por ,):</label>
                <textarea name="matriz_a" id="matriz_a" rows="3" placeholder="Ej: 1,2;3,4"><?= htmlspecialchars($datosFormulario['matriz_a'] ?? '1,2,3;4,5,6;7,8,9') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="matriz_b">Matriz B:</label>
                <textarea name="matriz_b" id="matriz_b" rows="3" placeholder="Ej: 9,8;7,6"><?= htmlspecialchars($datosFormulario['matriz_b'] ?? '9,8,7;6,5,4;3,2,1') ?></textarea>
            </div>
            
            <button type="submit" class="btn">Multiplicar Matrices</button>
        </form>
        
        <?php if (isset($resultados['matriz'])): ?>
        <div class="result">
            <h4>Resultado de A × B:</h4>
            <table style="margin-top: 15px; border-collapse: collapse;">
                <?php foreach ($resultados['matriz'] as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 60px;">
                        <?= number_format($valor, 2) ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    
    <script>
        function showTab(tabName) {
            // Ocultar todas las pestañas
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            // Mostrar la pestaña seleccionada
            document.getElementById(tabName + '-tab').style.display = 'block';
        }
    </script>
</body>
</html>
