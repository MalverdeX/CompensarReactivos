// Script para cargar contenido dinámicamente
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los elementos del menú
    const menuItems = document.querySelectorAll('.menu-item');
    const contentArea = document.getElementById('content-area');
    
    // Agregar evento click a cada item del menú
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover clase active de todos los items
            menuItems.forEach(mi => mi.classList.remove('active'));
            
            // Agregar clase active al item actual
            this.classList.add('active');
            
            // Obtener el archivo a cargar
            const contentFile = this.getAttribute('data-content');
            
            // Mostrar indicador de carga
            contentArea.innerHTML = `
                <div style="text-align: center; padding: 50px;">
                    <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                    <p style="margin-top: 20px; color: #666;">Cargando contenido...</p>
                </div>
                <style>
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            `;
            
            // Cargar el contenido
            loadContent(contentFile);
        });
    });
    
    // Función para cargar contenido
    function loadContent(file) {
        // Detectar si es un archivo PHP
        const isPhp = file.endsWith('.php');
        
        if (isPhp) {
            // Para archivos PHP, necesitamos cargarlos desde un servidor
            // Si estás en un servidor local, esto funcionará
            // Si no, mostramos un mensaje explicativo
            loadPhpContent(file);
        } else {
            // Para archivos HTML, podemos cargarlos directamente
            loadHtmlContent(file);
        }
    }
    
    // Función para cargar contenido HTML
    function loadHtmlContent(file) {
        fetch(file)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                // Extraer solo el contenido del body
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const bodyContent = doc.body.innerHTML;
                
                contentArea.innerHTML = bodyContent;
                
                // Ejecutar scripts que puedan estar en el contenido cargado
                executeScripts(contentArea);
            })
            .catch(error => {
                console.error('Error cargando contenido:', error);
                showError(`No se pudo cargar el archivo ${file}. Error: ${error.message}`);
            });
    }
    
    // Función para manejar contenido PHP
    function loadPhpContent(file) {
        // Intentar cargar desde el servidor
        fetch(file)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                contentArea.innerHTML = html;
                executeScripts(contentArea);
            })
            .catch(error => {
                // Si falla, mostrar mensaje explicativo
                showPhpInfo(file);
            });
    }
    
    // Función para mostrar información sobre PHP
    function showPhpInfo(file) {
        const phpFiles = {
            'calculadora.php': {
                title: 'Calculadora PHP',
                description: 'Realiza operaciones matemáticas básicas usando PHP.',
                features: ['Suma, resta, multiplicación, división', 'Cálculo de potencias', 'Procesamiento en tiempo real'],
                demo: 'Puedes probar operaciones como: 5 + 3 = 8, 2^3 = 8'
            },
            'datos.php': {
                title: 'Datos Dinámicos PHP',
                description: 'Manejo de datos con búsqueda y estadísticas.',
                features: ['Búsqueda dinámica de usuarios', 'Estadísticas automáticas', 'Filtrado de datos'],
                demo: 'Busca por nombre, email o ciudad para ver el filtrado en acción.'
            },
            'calculos-complejos.php': {
                title: 'Cálculos Complejos PHP',
                description: 'Ejemplos avanzados de capacidades matemáticas de PHP.',
                features: ['Estadísticas descriptivas', 'Regresión lineal', 'Multiplicación de matrices'],
                demo: 'PHP calcula: media, mediana, desviación estándar, ecuaciones de regresión y más.'
            }
        };
        
        const fileInfo = phpFiles[file] || {
            title: 'Archivo PHP',
            description: 'Contenido dinámico generado con PHP.',
            features: ['Procesamiento en servidor', 'Lógica compleja', 'Integración con bases de datos'],
            demo: 'Este archivo requiere un servidor PHP para funcionar correctamente.'
        };
        
        contentArea.innerHTML = `
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px;">
                <h1 style="margin-bottom: 20px;">${fileInfo.title}</h1>
                <p style="font-size: 1.1rem; margin-bottom: 20px;">${fileInfo.description}</p>
            </div>
            
            <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 20px; margin-bottom: 30px;">
                <h3 style="color: #856404; margin-bottom: 15px;">⚠️ Requiere Servidor PHP</h3>
                <p style="color: #856404; margin-bottom: 15px;">
                    Este archivo contiene código PHP que debe ser ejecutado en un servidor web con PHP instalado.
                </p>
                <p style="color: #856404; margin-bottom: 15px;">
                    <strong>Para verlo funcionar:</strong><br>
                    1. Instala XAMPP, WAMP, o un servidor similar<br>
                    2. Coloca estos archivos en la carpeta htdocs/www<br>
                    3. Accede via http://localhost/tu-carpeta/
                </p>
            </div>
            
            <div style="background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; padding: 20px; margin-bottom: 30px;">
                <h3 style="color: #155724; margin-bottom: 15px;">🚀 Características de este archivo:</h3>
                <ul style="color: #155724;">
                    ${fileInfo.features.map(feature => `<li>${feature}</li>`).join('')}
                </ul>
            </div>
            
            <div style="background-color: #e2e3e5; border-radius: 5px; padding: 20px;">
                <h3 style="color: #383d41; margin-bottom: 15px;">💡 Demostración:</h3>
                <p style="color: #383d41;">${fileInfo.demo}</p>
            </div>
            
            <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                <h3>¿Por qué PHP es excelente para cálculos complejos?</h3>
                <ul>
                    <li><strong>Rendimiento:</strong> PHP está optimizado para procesamiento del lado del servidor</li>
                    <li><strong>Bibliotecas matemáticas:</strong> Funciones incorporadas para cálculos avanzados</li>
                    <li><strong>Manejo de datos:</strong> Procesamiento eficiente de grandes volúmenes de datos</li>
                    <li><strong>Integración:</strong> Fácil conexión con bases de datos y APIs externas</li>
                    <li><strong>Escalabilidad:</strong> Puede manejar desde simples cálculos hasta complejos análisis</li>
                </ul>
            </div>
        `;
    }
    
    // Función para mostrar errores
    function showError(message) {
        contentArea.innerHTML = `
            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; padding: 20px; text-align: center;">
                <h3 style="color: #721c24;">❌ Error</h3>
                <p style="color: #721c24;">${message}</p>
                <button onclick="location.reload()" class="btn" style="margin-top: 15px;">Recargar Página</button>
            </div>
        `;
    }
    
    // Función para ejecutar scripts en el contenido cargado
    function executeScripts(container) {
        const scripts = container.querySelectorAll('script');
        scripts.forEach(script => {
            const newScript = document.createElement('script');
            if (script.src) {
                newScript.src = script.src;
            } else {
                newScript.textContent = script.textContent;
            }
            document.head.appendChild(newScript);
        });
    }
    
    // Cargar contenido inicial (opcional)
    // Puedes descomentar esta línea si quieres cargar contenido automáticamente al inicio
    // menuItems[0].click();
});
