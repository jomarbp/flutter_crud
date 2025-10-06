# CRUD Flutter - Aplicación de Gestión de Usuarios

Una aplicación Flutter que implementa operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para la gestión de usuarios, conectada a una API REST desarrollada en PHP con base de datos MySQL.

## 📱 Características

- **Interfaz moderna y responsive** con Material Design
- **Visualización de usuarios** en formato tabla con diseño atractivo
- **Carga asíncrona** con indicadores de progreso
- **Manejo de errores** con mensajes informativos
- **Actualización en tiempo real** con botón de refresh
- **Conexión a API REST** para operaciones de base de datos

## 🏗️ Arquitectura del Proyecto

### Frontend (Flutter)
```
lib/
├── main.dart              # Punto de entrada y UI principal
├── models/
│   └── usuario.dart       # Modelo de datos Usuario
└── services/
    └── usuario_service.dart # Servicio para comunicación con API
```

### Backend (PHP API)
```
c:\xampp08\htdocs\api_flutter/
├── api.php               # Endpoint principal de la API REST
├── conexion.php          # Configuración de conexión a base de datos
├── crud_flutter.sql      # Script de creación de base de datos
└── test_api.html         # Archivo de pruebas de la API
```

## 🛠️ Tecnologías Utilizadas

### Frontend
- **Flutter** 3.9.0+
- **Dart** SDK ^3.9.0
- **http** ^1.1.0 - Para peticiones HTTP
- **Material Design** - Para la interfaz de usuario

### Backend
- **PHP** - Lenguaje del servidor
- **MySQL/MariaDB** - Base de datos
- **PDO** - Para conexión segura a base de datos
- **XAMPP** - Servidor local de desarrollo

## 📋 Requisitos Previos

### Para el Frontend (Flutter)
- Flutter SDK 3.9.0 o superior
- Dart SDK ^3.9.0
- Android Studio / VS Code
- Emulador Android o dispositivo físico

### Para el Backend (API)
- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 o superior
- MySQL 5.7 o superior

## 🚀 Instalación y Configuración

### 1. Configuración del Backend

#### Paso 1: Instalar XAMPP
1. Descargar e instalar XAMPP desde [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Iniciar los servicios Apache y MySQL desde el panel de control de XAMPP

#### Paso 2: Configurar la API
1. Copiar la carpeta `api_flutter` a la ruta:
   ```
   c:\xampp08\htdocs\api_flutter\
   ```

2. Crear la base de datos:
   - Abrir phpMyAdmin en `http://localhost/phpmyadmin`
   - Importar el archivo `crud_flutter.sql`
   - O ejecutar manualmente:
   ```sql
   CREATE DATABASE crud_flutter;
   USE crud_flutter;
   
   CREATE TABLE usuarios (
     id int(11) NOT NULL AUTO_INCREMENT,
     nombre varchar(100) DEFAULT NULL,
     email varchar(100) DEFAULT NULL,
     password varchar(255) DEFAULT NULL,
     PRIMARY KEY (id),
     UNIQUE KEY email (email)
   );
   ```

#### Paso 3: Verificar la API
- Acceder a `http://localhost/api_flutter/test_api.html` para probar los endpoints
- La API estará disponible en: `http://localhost/api_flutter/api.php`

### 2. Configuración del Frontend

#### Paso 1: Clonar/Descargar el proyecto Flutter
```bash
cd "c:\Users\o\Desktop\APLICATIVO DEMO\crud_flutter"
```

#### Paso 2: Instalar dependencias
```bash
flutter pub get
```

#### Paso 3: Verificar configuración
- Asegurarse de que la URL de la API en `lib/services/usuario_service.dart` sea correcta:
```dart
static const String baseUrl = 'http://localhost/api_flutter/api.php';
```

#### Paso 4: Ejecutar la aplicación
```bash
flutter run
```

## 🔧 Configuración de la API

### Endpoints Disponibles

La API maneja las siguientes operaciones mediante POST a `http://localhost/api_flutter/api.php`:

| Acción | Parámetros | Descripción |
|--------|------------|-------------|
| `read` | `action=read` | Obtiene todos los usuarios |
| `create` | `action=create`, `nombre`, `email`, `password` | Crea un nuevo usuario |
| `update` | `action=update`, `id`, `nombre` | Actualiza un usuario existente |
| `delete` | `action=delete`, `id` | Elimina un usuario |

### Configuración de Base de Datos

El archivo `conexion.php` contiene la configuración de conexión:
```php
$host = "localhost";
$db = "crud_flutter";
$user = "root";
$pass = "";
```

## 📱 Funcionalidades de la App

### Pantalla Principal
- **Lista de usuarios**: Muestra todos los usuarios en formato tabla
- **Contador de usuarios**: Indica el total de registros
- **Estados de carga**: Indicadores visuales durante las operaciones
- **Manejo de errores**: Mensajes informativos cuando hay problemas de conexión
- **Botón de actualización**: Permite recargar los datos manualmente

### Características Técnicas
- **Arquitectura limpia**: Separación entre modelos, servicios y UI
- **Programación asíncrona**: Uso de Future/async-await
- **Manejo de estados**: setState para actualización de UI
- **Diseño responsive**: Adaptable a diferentes tamaños de pantalla

## 🎨 Diseño y UI

La aplicación utiliza Material Design con:
- **Colores**: Paleta azul como color principal
- **Gradientes**: Fondo degradado para mejor apariencia
- **Cards**: Elementos elevados para mejor jerarquía visual
- **Iconografía**: Icons de Material Design
- **Tipografía**: Diferentes pesos y tamaños para jerarquía

## 🔍 Estructura de Datos

### Modelo Usuario
```dart
class Usuario {
  final int id;
  final String nombre;
  final String email;
  
  // Constructores y métodos de serialización
}
```

### Tabla de Base de Datos
```sql
usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
)
```

## 🚨 Solución de Problemas

### Problemas Comunes

1. **Error de conexión a la API**
   - Verificar que XAMPP esté ejecutándose
   - Comprobar que la URL de la API sea correcta
   - Revisar los logs de Apache en XAMPP

2. **Error de base de datos**
   - Verificar que MySQL esté iniciado
   - Comprobar que la base de datos `crud_flutter` exista
   - Revisar las credenciales en `conexion.php`

3. **Problemas con Flutter**
   - Ejecutar `flutter clean` y `flutter pub get`
   - Verificar la versión de Flutter con `flutter doctor`

## 📝 Próximas Mejoras

- [ ] Implementar operaciones CREATE, UPDATE y DELETE en la UI
- [ ] Agregar validación de formularios
- [ ] Implementar autenticación de usuarios
- [ ] Agregar paginación para grandes conjuntos de datos
- [ ] Mejorar el manejo de errores
- [ ] Agregar tests unitarios
- [ ] Implementar modo offline

## 👥 Contribución

Para contribuir al proyecto:
1. Fork del repositorio
2. Crear una rama para la nueva funcionalidad
3. Realizar los cambios necesarios
4. Enviar un Pull Request

## 📄 Licencia

Este proyecto es de uso educativo y demostrativo.

---

**Nota**: Este proyecto está configurado para funcionar en un entorno de desarrollo local con XAMPP. Para producción, se recomienda configurar un servidor web apropiado y ajustar las configuraciones de seguridad correspondientes.
