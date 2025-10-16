# 🏪 EXAMEN PRÁCTICO - INDICADOR N°1
## Sistema de Gestión de Inventario de Tienda
### CRUD Completo con Laravel 10, Blade y MySQL

---

## 🎯 **INFORMACIÓN GENERAL**

**Asignatura:** Desarrollo de Aplicaciones Web  
**Indicador de Logro N°1:** Implementa operaciones CRUD completas utilizando Laravel 10 como framework backend, Blade como motor de plantillas y MySQL como base de datos  
**Modalidad:** Examen Práctico Individual  
**Duración:** 4 horas académicas  
**Fecha de Entrega:** [Definir fecha]  
**Peso Evaluativo:** 25% de la nota final  

---

## 📋 **DESCRIPCIÓN DEL CASO PRÁCTICO**

Usted ha sido contratado como desarrollador Full-Stack para crear un **Sistema de Gestión de Inventario** para una tienda de electrónicos. El sistema debe permitir a los administradores realizar operaciones completas de gestión de productos (Crear, Leer, Actualizar y Eliminar), así como controlar el stock y categorías de productos.

---

## 🎯 **OBJETIVOS ESPECÍFICOS**

Al finalizar este examen, el estudiante será capaz de:

1. **Diseñar y crear** una base de datos MySQL con estructura normalizada
2. **Desarrollar** una aplicación web en Laravel 10 con operaciones CRUD completas
3. **Implementar** vistas con Blade templates y diseño responsivo
4. **Utilizar** Eloquent ORM para la gestión de datos
5. **Documentar** y **presentar** el proyecto de manera profesional

---

## 📊 **ESPECIFICACIONES TÉCNICAS**

### **🗄️ Base de Datos (MySQL)**
Crear una base de datos llamada `inventario_tienda` con las siguientes tablas:

**Tabla: `categorias`**
```sql
- id (BIGINT, AUTO_INCREMENT, PRIMARY KEY)
- nombre (VARCHAR(100), NOT NULL)
- descripcion (TEXT, NULLABLE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

**Tabla: `productos`**
```sql
- id (BIGINT, AUTO_INCREMENT, PRIMARY KEY)
- nombre (VARCHAR(200), NOT NULL)
- descripcion (TEXT, NULLABLE)
- precio (DECIMAL(10,2), NOT NULL)
- stock (INT, NOT NULL, DEFAULT 0)
- categoria_id (BIGINT, FOREIGN KEY)
- codigo_barras (VARCHAR(50), UNIQUE, NOT NULL)
- imagen (VARCHAR(255), NULLABLE)
- activo (BOOLEAN, DEFAULT TRUE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

**Datos de Ejemplo (mínimo 8 productos en 3 categorías):**

*Categorías:*
- Smartphones
- Laptops
- Accesorios

*Productos:*
- iPhone 15 Pro - Smartphones
- Samsung Galaxy S24 - Smartphones
- MacBook Air M2 - Laptops
- Dell XPS 13 - Laptops
- AirPods Pro - Accesorios
- Logitech MX Master 3 - Accesorios

### **🔧 Aplicación Laravel 10**
Desarrollar una aplicación web que incluya:

**Estructura MVC:**
```
app/
├── Http/
│   └── Controllers/
│       ├── ProductoController.php
│       └── CategoriaController.php
├── Models/
│   ├── Producto.php
│   └── Categoria.php
└── ...

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── productos/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── categorias/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php
└── ...

database/
├── migrations/
└── seeders/
```

**Funcionalidades Requeridas:**
- 🏠 **Dashboard:** Resumen de inventario con estadísticas
- 📦 **Gestión de Productos:** CRUD completo con validaciones
- 🏷️ **Gestión de Categorías:** CRUD básico
- 🔍 **Búsqueda y Filtros:** Por nombre, categoría y stock
- 📊 **Reportes:** Productos con stock bajo
- 🖼️ **Subida de Imágenes:** Para productos (opcional - puntos extra)

---

## 🛠️ **HERRAMIENTAS Y TECNOLOGÍAS**

### **Obligatorias:**
- **PHP 8.1+**
- **Laravel 10** (framework)
- **Composer** (gestor de dependencias)
- **XAMPP** o **Laragon** (Apache + MySQL + PHP)
- **Visual Studio Code** con extensiones PHP
- **Git** (control de versiones)

### **Dependencias Laravel:**
```json
{
    "require": {
        "php": "^8.1",
        "laravel/framework": "^10.0",
        "laravel/tinker": "^2.8"
    },
    "require-dev": {
        "laravel/pint": "^1.0",
        "nunomaduro/collision": "^7.0",
        "phpunit/phpunit": "^10.0"
    }
}
```

### **Frontend (incluido en Laravel):**
- **Blade Templates**
- **Bootstrap 5** (CDN)
- **JavaScript vanilla** para interactividad

---

## 📝 **ENTREGABLES**

### **1. Código Fuente (60%)**
- ✅ Proyecto Laravel 10 completo y funcional
- ✅ Modelos con relaciones Eloquent
- ✅ Controladores con métodos CRUD
- ✅ Vistas Blade responsivas y atractivas
- ✅ Migraciones y seeders de base de datos
- ✅ Validaciones de formularios
- ✅ Código limpio, comentado y bien estructurado

### **2. Documentación Técnica (20%)**
**Archivo: `INFORME_TECNICO.md`**
- Arquitectura MVC implementada
- Diagrama de base de datos con relaciones
- Rutas y controladores desarrollados
- Capturas de pantalla de todas las funcionalidades
- Instrucciones de instalación y configuración
- Problemas encontrados y soluciones implementadas

### **3. Exposición Oral (20%)**
**Duración:** 10-15 minutos por estudiante
- Demostración en vivo de la aplicación
- Explicación de la arquitectura MVC
- Mostrar operaciones CRUD funcionando
- Explicar relaciones entre modelos
- Responder preguntas técnicas del docente
- Mostrar código relevante y explicar decisiones de diseño

---

## 🎯 **CRITERIOS DE EVALUACIÓN**
### **CALIFICACIÓN TOTAL: 20 PUNTOS**

### **Funcionalidad (8 puntos)**
| Criterio | Excelente (2.0) | Bueno (1.5) | Regular (1.0) | Deficiente (0.5) |
|----------|-----------------|-------------|---------------|------------------|
| **CREATE** | Funciona perfectamente con validaciones Laravel | Funciona con validaciones básicas | Funciona sin validaciones | No funciona |
| **READ** | Lista con paginación, filtros y diseño atractivo | Lista básica funcional | Lista con errores menores | No funciona |
| **UPDATE** | Edición completa con validaciones | Edición básica funcional | Edición con errores | No funciona |
| **DELETE** | Eliminación con confirmación y soft deletes | Eliminación básica | Eliminación sin confirmación | No funciona |

### **Calidad Técnica (6 puntos)**
- **Arquitectura MVC:** Separación correcta de responsabilidades (2 pts)
- **Código Laravel:** Uso correcto de Eloquent, rutas y middleware (2 pts)
- **Base de Datos:** Migraciones, relaciones y seeders (2 pts)

### **Documentación (3 puntos)**
- **Informe Técnico:** Completo y bien estructurado (2 pts)
- **Comentarios en Código:** Explicaciones claras (1 pt)

### **Exposición (3 puntos)**
- **Demostración:** Funcionalidad completa en vivo (1.5 pts)
- **Explicación Técnica:** Claridad y dominio del tema (1.5 pts)

---

## 🚀 **INSTRUCCIONES DE DESARROLLO**

### **Fase 1: Preparación del Entorno (30 min)**
1. Instalar y configurar XAMPP/Laragon
2. Crear nuevo proyecto Laravel 10
3. Configurar base de datos en `.env`
4. Instalar dependencias con Composer

### **Fase 2: Base de Datos y Modelos (45 min)**
1. Crear migraciones para `categorias` y `productos`
2. Definir relaciones en modelos Eloquent
3. Crear seeders con datos de ejemplo
4. Ejecutar migraciones y seeders

### **Fase 3: Controladores y Rutas (60 min)**
1. Crear `ProductoController` con métodos resource
2. Crear `CategoriaController` básico
3. Definir rutas en `web.php`
4. Implementar validaciones con Form Requests

### **Fase 4: Vistas Blade (90 min)**
1. Crear layout principal con Bootstrap
2. Desarrollar vistas para productos (index, create, edit, show)
3. Crear vistas para categorías
4. Implementar dashboard con estadísticas
5. Añadir funcionalidades de búsqueda y filtros

### **Fase 5: Documentación y Pruebas (15 min)**
1. Completar informe técnico
2. Realizar pruebas finales
3. Preparar exposición

---

## 📋 **FORMATO DE ENTREGA**

### **Estructura de Carpetas:**
```
APELLIDO_NOMBRE_EXAMEN_N1_LARAVEL/
├── inventario-tienda/           # Proyecto Laravel
├── database/                    # Backup SQL
├── docs/                        # Documentación
│   ├── INFORME_TECNICO.md
│   └── capturas/               # Screenshots
└── README.md                   # Instrucciones generales
```

### **Métodos de Entrega:**
- **Repositorio Git:** Subir a GitHub/GitLab (recomendado)
- **Archivo ZIP:** Comprimir carpeta completa
- **Presentación:** Preparar demo en vivo

---

## ⚠️ **CONSIDERACIONES IMPORTANTES**

### **Restricciones:**
- ❌ **Prohibido** el uso de paquetes externos no autorizados
- ❌ **No se permite** copiar código de otros estudiantes
- ❌ **No usar** generadores automáticos de CRUD
- ✅ **Permitido** consultar documentación oficial de Laravel

### **Penalizaciones:**
- **Entrega tardía:** -2 puntos por día
- **Código no funcional:** -4 puntos
- **Plagio detectado:** Calificación de 0
- **No presentar exposición:** -3 puntos

### **Puntos Extra (máximo 1 punto):**
- 🖼️ **Subida de imágenes** para productos (+0.5 pts)
- 📊 **Dashboard avanzado** con gráficos (+0.3 pts)
- 🎨 **Diseño UI/UX** excepcional con CSS personalizado (+0.2 pts)

---

## 📞 **SOPORTE TÉCNICO**

**Durante el Examen:**
- Consultas sobre enunciado: Permitidas
- Ayuda con errores de sintaxis: Limitada
- Resolución de problemas de lógica: No permitida

**Contacto Docente:**
- Email: [correo_docente]
- Horario de consultas: [horario]

---

## 🎓 **RECURSOS RECOMENDADOS**

### **Documentación Oficial:**
- [Laravel 10 Documentation](https://laravel.com/docs/10.x)
- [Eloquent ORM](https://laravel.com/docs/10.x/eloquent)
- [Blade Templates](https://laravel.com/docs/10.x/blade)
- [Laravel Migrations](https://laravel.com/docs/10.x/migrations)

### **Tutoriales de Referencia:**
- Laravel CRUD Operations
- Eloquent Relationships
- Blade Template Inheritance
- Laravel Form Validation

---

## 🔧 **COMANDOS ÚTILES DE LARAVEL**

```bash
# Crear nuevo proyecto
composer create-project laravel/laravel inventario-tienda

# Crear modelo con migración y controlador
php artisan make:model Producto -mcr

# Ejecutar migraciones
php artisan migrate

# Crear seeder
php artisan make:seeder ProductoSeeder

# Ejecutar seeders
php artisan db:seed

# Servir aplicación
php artisan serve
```

---

**¡Éxito en su examen! Demuestre sus habilidades como desarrollador Laravel.**

---

*Documento generado para evaluación académica - Indicador N°1*  
*Versión 1.0 - Laravel 10 Edition*