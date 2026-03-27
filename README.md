# Web App con Menú Dinámico - HTML y PHP

Una aplicación web simple con menú vertical y contenido dinámico que demuestra las capacidades de PHP para cálculos complejos.

## 📁 Estructura de Archivos

```
├── index.html              # Página principal con el layout
├── styles.css              # Estilos CSS para el diseño
├── script.js               # JavaScript para carga dinámica
├── inicio.html             # Página de inicio (contenido estático)
├── formulario.html         # Formulario de contacto (HTML + JS)
├── calculadora.php         # Calculadora básica con PHP
├── datos.php               # Manejo dinámico de datos
├── calculos-complejos.php  # Cálculos matemáticos avanzados
└── README.md               # Este archivo
```

## 🚀 Características

### ✅ Diseño Web Moderno
- **Menú vertical** a la izquierda con navegación intuitiva
- **Área de contenido central** que cambia dinámicamente
- **Diseño responsive** que se adapta a diferentes pantallas
- **Interfaz profesional** con colores modernos y transiciones suaves

### ✅ Contenido Dinámico
- **Carga asíncrona** de contenido con JavaScript
- **Soporte para HTML y PHP** en el área de contenido
- **Indicadores de carga** para mejor experiencia de usuario
- **Manejo inteligente de errores**

### ✅ Ejemplos de PHP
- **Calculadora básica:** Operaciones matemáticas fundamentales
- **Datos dinámicos:** Búsqueda, filtrado y estadísticas
- **Cálculos complejos:** Estadística descriptiva, regresión lineal, matrices

## 🛠️ Cómo Usar

### Para archivos HTML (sin servidor):
1. Abre `index.html` directamente en tu navegador
2. Los archivos HTML (`inicio.html`, `formulario.html`) funcionarán perfectamente
3. Navega por el menú para ver el contenido dinámico

### Para archivos PHP (requiere servidor):
1. **Instala un servidor local** (XAMPP, WAMP, MAMP, o similar)
2. **Coloca los archivos** en la carpeta del servidor (htdocs, www, etc.)
3. **Inicia el servidor** Apache y PHP
4. **Accede** via `http://localhost/tu-carpeta/`

## 💡 Demostración de Capacidades de PHP

### 🧮 Cálculos Complejos
PHP es excelente para cálculos matemáticos:

```php
// Ejemplo: Estadísticas avanzadas
function calcularEstadisticas($datos) {
    $media = array_sum($datos) / count($datos);
    $varianza = 0;
    foreach ($datos as $valor) {
        $varianza += pow($valor - $media, 2);
    }
    $desviacion = sqrt($varianza / count($datos));
    return ['media' => $media, 'desviacion' => $desviacion];
}
```

### 📊 Procesamiento de Datos
- **Análisis estadístico:** Media, mediana, desviación estándar
- **Álgebra lineal:** Multiplicación de matrices
- **Regresión:** Cálculo de tendencias y predicciones
- **Manejo de grandes volúmenes:** Filtrado y búsqueda eficiente

### 🔧 Ventajas de PHP para Cálculos
- **Rendimiento:** Optimizado para procesamiento del lado del servidor
- **Bibliotecas:** Funciones matemáticas incorporadas
- **Integración:** Fácil conexión con bases de datos
- **Escalabilidad:** Desde simples cálculos hasta análisis complejos

## 🎯 Ejemplos Prácticos

### 1. Calculadora PHP
Realiza operaciones matemáticas básicas:
- Suma, resta, multiplicación, división
- Cálculo de potencias
- Manejo de errores (división por cero)

### 2. Datos Dinámicos
Sistema de gestión de usuarios con:
- Búsqueda en tiempo real
- Estadísticas automáticas
- Filtrado condicional
- Visualización de datos en tablas

### 3. Cálculos Complejos
Herramientas matemáticas avanzadas:
- Estadística descriptiva completa
- Regresión lineal con coeficiente R²
- Multiplicación de matrices
- Análisis de datos multidimensional

## 🎨 Personalización

### Modificar el Menú
Edita `index.html` para agregar nuevas opciones:

```html
<li><a href="#" data-content="nuevo-archivo.php" class="menu-item">Nueva Opción</a></li>
```

### Cambiar Colores
Modifica `styles.css` para personalizar el diseño:

```css
.sidebar {
    background-color: #tu-color; /* Cambiar color del menú */
}

.content {
    background-color: #tu-color; /* Cambiar color del contenido */
}
```

### Agregar Nuevo Contenido
1. Crea un nuevo archivo (HTML o PHP)
2. Agrega la opción al menú en `index.html`
3. El JavaScript cargará automáticamente el contenido

## 🔧 Requisitos Técnicos

### Para HTML/CSS/JavaScript:
- Navegador web moderno (Chrome, Firefox, Safari, Edge)
- Sin requisitos adicionales

### Para PHP:
- Servidor web con PHP 7.4+ recomendado
- Apache/Nginx
- (Opcional) Base de datos MySQL/MariaDB para datos persistentes

## 🚀 Siguientes Pasos

1. **Explora los ejemplos** existentes
2. **Modifica los cálculos** según tus necesidades
3. **Agrega nuevas funcionalidades** matemáticas
4. **Conecta con bases de datos** para datos persistentes
5. **Implementa APIs** para cálculos más complejos

## 📚 Recursos Adicionales

- [Documentación oficial de PHP](https://www.php.net/docs.php)
- [Funciones matemáticas de PHP](https://www.php.net/manual/en/book.math.php)
- [JavaScript MDN](https://developer.mozilla.org/es/docs/Web/JavaScript)
- [CSS Tricks](https://css-tricks.com/)

---

**¡Listo para empezar!** Abre `index.html` en tu navegador para ver la aplicación en acción.
