# 🚀 Framework PHP MVC - Segundo Parcial Web

Framework PHP moderno construido con arquitectura MVC limpia y organizada.

## 📁 Estructura del Proyecto

```
segundo-parcial-web/
│
├── core/                          # 🔧 Núcleo del framework
│   ├── Application/               # Aplicación principal
│   │   └── App.php               # Bootstrap de la aplicación
│   │
│   ├── Http/                      # Manejo HTTP
│   │   ├── Request.php           # Procesamiento de peticiones
│   │   └── Response.php          # Manejo de respuestas
│   │
│   ├── Routing/                   # Sistema de enrutamiento
│   │   ├── Router.php            # Enrutador principal
│   │   └── Route.php             # Rutas individuales
│   │
│   └── View/                      # Sistema de vistas
│       └── View.php              # Renderizado de templates
│
├── app/                           # 📦 Código de la aplicación
│   ├── Controllers/               # Controladores
│   │   └── HomeController.php
│   │
│   ├── Models/                    # Modelos de datos
│   │   └── HomeModel.php
│   │
│   ├── Services/                  # Lógica de negocio
│   │   └── HomeService.php
│   │
│   ├── Views/                     # Plantillas de vistas
│   │   ├── home/
│   │   │   ├── index.php
│   │   │   └── about.php
│   │   └── layouts/
│   │       └── main.php
│   │
│   └── routes.php                # Definición de rutas
│
├── public/                        # 🌐 Directorio público
│   ├── index.php                 # Punto de entrada
│   └── .htaccess                 # Configuración Apache
│
└── vendor/                        # 📚 Dependencias de Composer

```

## 🎯 Características

### ✨ Core Framework

- **🏗️ Arquitectura MVC**: Separación clara de responsabilidades
- **🛣️ Sistema de Routing**: Enrutamiento flexible con soporte para:
  - Parámetros dinámicos
  - Grupos de rutas
  - Middlewares globales y por ruta
  - Closures y controladores
- **🌐 HTTP Moderno**:
  - Request con soporte para JSON
  - Response con métodos fluidos
  - Manejo de headers y cookies
- **🎨 Sistema de Vistas**:
  - Templates con layouts reutilizables
  - Metadata para SEO
  - Renderizado limpio con output buffering

### 🏠 Aplicación Home

La aplicación incluye un módulo Home completo siguiendo MVC:

#### Controller (`HomeController`)

- `index()` - Página de inicio
- `about()` - Página acerca de
- `apiData()` - Endpoint JSON

#### Service (`HomeService`)

- Lógica de negocio
- Procesamiento de datos
- Saludo dinámico basado en hora

#### Model (`HomeModel`)

- Datos del sitio
- Estadísticas
- Características del framework

#### Views

- Layout principal responsive
- Vista home/index con estadísticas
- Vista home/about con información

## 🚀 Inicio Rápido

### 1. Configurar el servidor

```bash
# Con PHP built-in server
php -S localhost:8000 -t public

# Con Apache/Nginx, apuntar document root a /public
```

### 2. Acceder a la aplicación

```
http://localhost:8000/          # Página de inicio
http://localhost:8000/about     # Acerca de
http://localhost:8000/api/data  # API JSON
http://localhost:8000/test      # Ruta de prueba
```

## 📚 Uso del Framework

### Definir Rutas

En `src/routes.php`:

```php
// Ruta GET simple
$router->get('/', [HomeController::class, 'index']);

// Ruta con parámetro
$router->get('/user/{id}', [UserController::class, 'show']);

// Ruta con closure
$router->get('/test', function ($request, $response) {
    return $response->json(['message' => 'Hello']);
});

// Grupo de rutas
$router->group('/api', function ($router) {
    $router->get('/users', [UserController::class, 'list']);
    $router->post('/users', [UserController::class, 'create']);
});
```

### Crear un Controller

```php
namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\View\View;

class MiController
{
    public function index(Request $request, Response $response): Response
    {
        $view = View::make('mi-vista', ['data' => 'value'])
            ->withLayout('layouts/main', [
                'title' => 'Mi Página'
            ]);

        return $response->html($view->render());
    }
}
```

### Usar el Request

```php
// Obtener método HTTP
$method = $request->getMethod(); // GET, POST, etc.

// Obtener parámetros query
$id = $request->getQuery('id');
$allQuery = $request->getQuery();

// Obtener datos del body
$name = $request->getBody('name');
$allBody = $request->getBody();

// Verificar método
if ($request->isMethod('POST')) {
    // ...
}

// Headers
$contentType = $request->getHeader('Content-Type');
$allHeaders = $request->getAllHeaders();

// JSON automático
if ($request->isJson()) {
    $data = $request->getBody();
}
```

### Usar el Response

```php
// HTML
return $response->html('<h1>Hello</h1>');

// JSON
return $response->json(['status' => 'ok']);

// Texto plano
return $response->text('Plain text');

// Redirección
$response->redirect('/home');

// Con status code
return $response->json(['error' => 'Not found'], 404);

// Encadenar métodos
return $response
    ->setHeader('X-Custom', 'value')
    ->json(['data' => $data]);
```

### Crear Vistas

Vista en `src/Views/mi-vista.php`:

```php
<h1><?= $titulo ?></h1>
<p><?= $contenido ?></p>

<?php foreach ($items as $item): ?>
    <div><?= $item ?></div>
<?php endforeach; ?>
```

Usar en controller:

```php
$view = View::make('mi-vista', [
    'titulo' => 'Hola',
    'contenido' => 'Contenido aquí',
    'items' => [1, 2, 3]
]);
```

## 🏗️ Arquitectura

### Flujo de la Aplicación

```
1. public/index.php
   ↓
2. Autoloader (Core & App namespaces)
   ↓
3. Router carga src/routes.php
   ↓
4. Request captura datos HTTP
   ↓
5. Router coincide ruta
   ↓
6. Controller procesa request
   ↓
7. Service ejecuta lógica de negocio
   ↓
8. Model obtiene/procesa datos
   ↓
9. View renderiza template
   ↓
10. Response envía resultado al cliente
```

### Namespaces

- `Core\*` - Framework base (en `/core`)
- `App\*` - Código de aplicación (en `/src`)

### Autoloader

El framework incluye un autoloader PSR-4 personalizado que mapea:

```php
Core\Http\Request     -> core/Http/Request.php
App\Controllers\Home  -> src/Controllers/Home.php
```

## 🎨 Personalización

### Cambiar zona horaria

En `public/index.php`:

```php
date_default_timezone_set('America/Mexico_City');
```

### Modo producción

```php
error_reporting(0);
ini_set('display_errors', '0');
```

### Agregar middlewares

```php
// Global
$router->middleware(new AuthMiddleware());

// Por ruta
$router->get('/admin', [AdminController::class, 'index'])
    ->middleware(new AuthMiddleware());
```

## 📝 Licencia

Proyecto educativo para Segundo Parcial Web.

## 👨‍💻 Desarrollo

Desarrollado con ❤️ usando PHP puro, sin dependencias externas para el core.

---

**Version:** 1.0.0
