# 📱 **EXAMEN PRÁCTICO - INDICADOR N°1**
## **Sistema de Gestión de Inventario de Tienda**
### **Desarrollo de Aplicación CRUD con Flutter, PHP y MySQL**

---

## 📋 **INFORMACIÓN GENERAL**

| **Campo** | **Detalle** |
|-----------|-------------|
| **Asignatura** | Desarrollo de Aplicaciones Móviles |
| **Indicador** | N°1 - Implementación de CRUD con Flutter |
| **Modalidad** | Examen Práctico Individual |
| **Duración** | 4 horas académicas |
| **Puntaje** | 100 puntos |
| **Fecha de Entrega** | [Definir según cronograma] |

---

## 🎯 **DESCRIPCIÓN DEL PROYECTO**

Desarrollar un **Sistema de Gestión de Inventario de Tienda** que permita administrar productos mediante operaciones CRUD (Create, Read, Update, Delete). El sistema debe integrar:

- 🗄️ **Base de Datos MySQL** para almacenar información de productos
- 🔧 **API REST en PHP** para manejar las operaciones del backend  
- 📱 **Aplicación Flutter** como interfaz de usuario móvil
- 🌐 **Integración completa** entre frontend y backend

---

## 🎯 **OBJETIVOS ESPECÍFICOS**

Al finalizar este examen, el estudiante será capaz de:

1. **Diseñar y crear** una base de datos MySQL con estructura normalizada
2. **Desarrollar** una API REST en PHP con operaciones CRUD completas
3. **Implementar** una aplicación móvil en Flutter que consuma la API
4. **Integrar** correctamente el frontend con el backend
5. **Documentar** y **presentar** el proyecto de manera profesional

---

## 📊 **ESPECIFICACIONES TÉCNICAS**

### **🗄️ Base de Datos (MySQL)**
Crear una base de datos llamada `inventario_tienda` con la siguiente tabla:

**Tabla: `productos`**
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- nombre (VARCHAR(200), NOT NULL)
- descripcion (TEXT, NOT NULL)
- codigo_barras (VARCHAR(50), UNIQUE, NOT NULL)
- categoria (VARCHAR(100), NOT NULL)
- precio (DECIMAL(10,2), NOT NULL)
- stock (INT, NOT NULL, DEFAULT 0)
- proveedor (VARCHAR(150), NOT NULL)
- fecha_ingreso (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
- activo (BOOLEAN, DEFAULT TRUE)
```

**Datos de Ejemplo (mínimo 5 productos):**
- "iPhone 15 Pro" - Smartphone Apple - Categoría: Celulares
- "Samsung Galaxy S24" - Smartphone Samsung - Categoría: Celulares  
- "MacBook Air M2" - Laptop Apple - Categoría: Computadoras
- "AirPods Pro" - Audífonos inalámbricos - Categoría: Accesorios
- "iPad Air" - Tablet Apple - Categoría: Tablets

### **🔧 API Backend (PHP)**
Desarrollar una API REST en PHP que incluya:

**Archivo: `api_inventario.php`**
- ✅ **CREATE:** Agregar nuevos productos
- ✅ **READ:** Listar todos los productos / Buscar por ID
- ✅ **UPDATE:** Actualizar información de productos
- ✅ **DELETE:** Eliminar productos del inventario
- ✅ **Validaciones:** Código de barras único, campos obligatorios, precio > 0
- ✅ **Manejo de errores** y respuestas JSON estructuradas

**Archivo: `conexion.php`**
- Configuración de conexión a MySQL
- Manejo de excepciones de conexión

### **📱 Aplicación Flutter**
Desarrollar una aplicación móvil con:

**Estructura de Archivos:**
```
lib/
├── main.dart
├── models/
│   └── producto.dart
├── services/
│   └── inventario_service.dart
└── screens/
    ├── lista_productos.dart
    ├── agregar_producto.dart
    ├── editar_producto.dart
    └── detalle_producto.dart
```

**Funcionalidades Requeridas:**
- 📦 **Pantalla Principal:** Lista de productos con diseño atractivo
- ➕ **Agregar Producto:** Formulario completo con validaciones
- ✏️ **Editar Producto:** Modificar información existente
- 🗑️ **Eliminar Producto:** Con confirmación de usuario
- 🔍 **Búsqueda:** Por nombre o código de barras (opcional - puntos extra)
- 📊 **Indicadores:** Stock bajo, productos activos/inactivos
- 💰 **Gestión de Precios:** Visualización clara de precios y stock

---

## 🛠️ **HERRAMIENTAS Y TECNOLOGÍAS**

### **Obligatorias:**
- **Flutter SDK** (versión estable)
- **XAMPP** (Apache + MySQL + PHP)
- **Visual Studio Code** o **Android Studio**
- **Insomnia** o **Postman** (para pruebas de API)
- **Git** (control de versiones)

### **Dependencias Flutter:**
```yaml
dependencies:
  flutter:
    sdk: flutter
  http: ^1.1.0
  cupertino_icons: ^1.0.2
```

---

## 📝 **ENTREGABLES**

### **1. 💻 Código Fuente**
- **Base de Datos:** Script SQL completo (`inventario_tienda.sql`)
- **Backend:** API PHP (`api_inventario.php`, `conexion.php`)
- **Frontend:** Proyecto Flutter completo con estructura organizada
- **Documentación:** README.md con instrucciones de instalación

### **2. 📊 Presentación Oral (15 minutos)**
**Estructura sugerida:**
1. **Introducción** (2 min): Presentación del sistema de inventario
2. **Demostración Técnica** (8 min):
   - Mostrar la base de datos y datos de ejemplo
   - Demostrar todas las operaciones CRUD en la app
   - Explicar la integración Flutter-PHP-MySQL
3. **Aspectos Técnicos** (3 min): Arquitectura y decisiones de diseño
4. **Conclusiones** (2 min): Aprendizajes y mejoras futuras

### **3. 📋 Informe Técnico**
**Documento PDF con:**
- **Portada:** Datos del estudiante y título del proyecto
- **Introducción:** Objetivos y alcance del sistema de inventario
- **Análisis:** Requerimientos funcionales y no funcionales
- **Diseño:** Diagrama de base de datos y arquitectura del sistema
- **Implementación:** Capturas de pantalla y explicación del código
- **Pruebas:** Evidencias de funcionamiento (screenshots)
- **Conclusiones:** Reflexión sobre el proceso de desarrollo

---

## 🎯 **CRITERIOS DE EVALUACIÓN**
### **CALIFICACIÓN TOTAL: 20 PUNTOS**

### **Funcionalidad (8 puntos)**
| Criterio | Excelente (2.0) | Bueno (1.5) | Regular (1.0) | Deficiente (0.5) |
|----------|-----------------|-------------|---------------|------------------|
| **CREATE** | Funciona perfectamente con validaciones | Funciona con validaciones básicas | Funciona sin validaciones | No funciona |
| **READ** | Lista completa con diseño atractivo | Lista básica funcional | Lista con errores menores | No funciona |
| **UPDATE** | Edición completa y validada | Edición básica funcional | Edición con errores | No funciona |
| **DELETE** | Eliminación con confirmación | Eliminación básica | Eliminación sin confirmación | No funciona |

### **Calidad Técnica (6 puntos)**
- **Arquitectura:** Separación correcta de responsabilidades (2 pts)
- **Código:** Limpieza, comentarios y buenas prácticas (2 pts)
- **Base de Datos:** Diseño normalizado y eficiente (2 pts)

### **Documentación (3 puntos)**
- **Informe Técnico:** Completo y bien estructurado (2 pts)
- **Comentarios en Código:** Explicaciones claras (1 pt)

### **Exposición (3 puntos)**
- **Demostración:** Funcionalidad completa en vivo (1.5 pts)
- **Explicación Técnica:** Claridad y dominio del tema (1.5 pts)

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
- [Flutter Documentation](https://docs.flutter.dev/)
- [PHP Manual](https://www.php.net/manual/)
- [MySQL Documentation](https://dev.mysql.com/doc/)

### **Tutoriales de Referencia:**
- Flutter HTTP Requests
- PHP PDO Database Connection
- MySQL CRUD Operations

---

**¡Éxito en su examen! Demuestre sus habilidades como desarrollador Full-Stack.**

---

*Documento generado para evaluación académica - Indicador N°1*  
*Versión 1.0 - [Fecha actual]*
