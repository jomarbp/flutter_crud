# 📚 EXAMEN PRÁCTICO - INDICADOR N°1
## Sistema de Gestión de Biblioteca Digital
### CRUD Completo con Flutter, PHP y MySQL

---

## 🎯 **INFORMACIÓN GENERAL**

**Asignatura:** Desarrollo de Aplicaciones Móviles  
**Indicador de Logro N°1:** Implementa operaciones CRUD completas utilizando Flutter como frontend, PHP como API backend y MySQL como base de datos  
**Modalidad:** Examen Práctico Individual  
**Duración:** 4 horas académicas  
**Fecha de Entrega:** [Definir fecha]  
**Peso Evaluativo:** 25% de la nota final  

---

## 📋 **DESCRIPCIÓN DEL CASO PRÁCTICO**

Usted ha sido contratado como desarrollador Full-Stack para crear un **Sistema de Gestión de Biblioteca Digital** que permita administrar el catálogo de libros de una biblioteca universitaria. El sistema debe permitir a los bibliotecarios realizar operaciones completas de gestión de libros (Crear, Leer, Actualizar y Eliminar).

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
Crear una base de datos llamada `biblioteca_digital` con la siguiente tabla:

**Tabla: `libros`**
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- titulo (VARCHAR(200), NOT NULL)
- autor (VARCHAR(150), NOT NULL)
- isbn (VARCHAR(20), UNIQUE, NOT NULL)
- categoria (VARCHAR(100), NOT NULL)
- año_publicacion (YEAR, NOT NULL)
- disponible (BOOLEAN, DEFAULT TRUE)
- fecha_registro (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
```

**Datos de Ejemplo (mínimo 5 libros):**
- "Cien Años de Soledad" - Gabriel García Márquez
- "Don Quijote de la Mancha" - Miguel de Cervantes
- "1984" - George Orwell
- "El Principito" - Antoine de Saint-Exupéry
- "Rayuela" - Julio Cortázar

### **🔧 API Backend (PHP)**
Desarrollar una API REST en PHP que incluya:

**Archivo: `api_biblioteca.php`**
- ✅ **CREATE:** Agregar nuevos libros
- ✅ **READ:** Listar todos los libros / Buscar por ID
- ✅ **UPDATE:** Actualizar información de libros
- ✅ **DELETE:** Eliminar libros del catálogo
- ✅ **Validaciones:** ISBN único, campos obligatorios
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
│   └── libro.dart
├── services/
│   └── biblioteca_service.dart
└── screens/
    ├── lista_libros.dart
    ├── agregar_libro.dart
    ├── editar_libro.dart
    └── detalle_libro.dart
```

**Funcionalidades Requeridas:**
- 📖 **Pantalla Principal:** Lista de libros con diseño atractivo
- ➕ **Agregar Libro:** Formulario completo con validaciones
- ✏️ **Editar Libro:** Modificar información existente
- 🗑️ **Eliminar Libro:** Con confirmación de usuario
- 🔍 **Búsqueda:** Por título o autor (opcional - puntos extra)
- 📊 **Indicadores:** Libros disponibles/no disponibles

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

### **1. Código Fuente (60%)**
- ✅ Proyecto Flutter completo y funcional
- ✅ API PHP con todas las operaciones CRUD
- ✅ Script SQL de creación de base de datos
- ✅ Código limpio, comentado y bien estructurado

### **2. Documentación Técnica (20%)**
**Archivo: `INFORME_TECNICO.md`**
- Arquitectura del sistema
- Diagrama de base de datos
- Endpoints de la API
- Capturas de pantalla de la aplicación
- Instrucciones de instalación y configuración
- Problemas encontrados y soluciones implementadas

### **3. Exposición Oral (20%)**
**Duración:** 10-15 minutos por estudiante
- Demostración en vivo de la aplicación
- Explicación de la arquitectura implementada
- Mostrar operaciones CRUD funcionando
- Responder preguntas técnicas del docente
- Mostrar código relevante y explicar decisiones de diseño

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

## 🚀 **INSTRUCCIONES DE DESARROLLO**

### **Fase 1: Preparación del Entorno (30 min)**
1. Instalar y configurar XAMPP
2. Crear proyecto Flutter
3. Configurar dependencias
4. Crear estructura de carpetas

### **Fase 2: Base de Datos (45 min)**
1. Crear base de datos `biblioteca_digital`
2. Crear tabla `libros` con estructura especificada
3. Insertar datos de ejemplo
4. Probar conexión desde PHP

### **Fase 3: API Backend (90 min)**
1. Desarrollar `conexion.php`
2. Implementar `api_biblioteca.php` con operaciones CRUD
3. Probar endpoints con Insomnia/Postman
4. Validar respuestas JSON

### **Fase 4: Aplicación Flutter (120 min)**
1. Crear modelo `Libro`
2. Implementar `BibliotecaService`
3. Desarrollar pantallas de la aplicación
4. Integrar con la API
5. Probar funcionalidades completas

### **Fase 5: Documentación y Pruebas (15 min)**
1. Completar informe técnico
2. Realizar pruebas finales
3. Preparar exposición

---

## 📋 **FORMATO DE ENTREGA**

### **Estructura de Carpetas:**
```
APELLIDO_NOMBRE_EXAMEN_N1/
├── flutter_biblioteca/          # Proyecto Flutter
├── api_biblioteca/              # API PHP
├── database/                    # Scripts SQL
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
- ❌ **Prohibido** el uso de librerías externas no autorizadas
- ❌ **No se permite** copiar código de otros estudiantes
- ❌ **No usar** generadores automáticos de código
- ✅ **Permitido** consultar documentación oficial

### **Penalizaciones:**
- **Entrega tardía:** -2 puntos por día
- **Código no funcional:** -4 puntos
- **Plagio detectado:** Calificación de 0
- **No presentar exposición:** -3 puntos

### **Puntos Extra (máximo 1 punto):**
- 🔍 **Búsqueda avanzada** por múltiples criterios (+0.5 pts)
- 📊 **Dashboard** con estadísticas (+0.3 pts)
- 🎨 **Diseño UI/UX** excepcional (+0.2 pts)

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