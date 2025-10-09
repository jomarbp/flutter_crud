===============================================
Tutorial: Implementación de CRUD Completo en Flutter
===============================================

:Autor: Instructor de Desarrollo Móvil
:Fecha: Diciembre 2024
:Versión: 1.0
:Tema: Desarrollo de aplicaciones Flutter con PHP API

.. contents:: Tabla de Contenidos
   :depth: 3

Introducción
============

Este tutorial te guiará paso a paso para implementar un sistema CRUD (Create, Read, Update, Delete) completo en Flutter, conectado a una API PHP. Al finalizar, tendrás una aplicación funcional que permite:

- **Crear** nuevos usuarios
- **Leer** y mostrar la lista de usuarios
- **Actualizar** información de usuarios existentes
- **Eliminar** usuarios del sistema

Prerrequisitos
===============

Antes de comenzar, asegúrate de tener:

1. **Flutter SDK** instalado y configurado
2. **Dart** configurado en tu IDE
3. **Servidor web local** (XAMPP, WAMP, o similar)
4. **Conocimientos básicos** de:
   - Dart y Flutter
   - PHP básico
   - Conceptos de API REST
   - Manejo de bases de datos MySQL

Estructura del Proyecto
=======================

El proyecto está organizado de la siguiente manera::

    crud_flutter/
    ├── lib/
    │   ├── main.dart              # Interfaz principal
    │   ├── models/
    │   │   └── usuario.dart       # Modelo de datos
    │   └── services/
    │       └── usuario_service.dart # Servicios de API
    ├── api/
    │   ├── api.php               # API PHP principal
    │   └── config.php            # Configuración de BD
    └── pubspec.yaml              # Dependencias Flutter

Paso 1: Configuración Inicial del Proyecto
===========================================

1.1 Crear el Proyecto Flutter
------------------------------

.. code-block:: bash

   flutter create crud_flutter
   cd crud_flutter

1.2 Configurar Dependencias
---------------------------

Edita el archivo ``pubspec.yaml`` y agrega las dependencias necesarias:

.. code-block:: yaml

   dependencies:
     flutter:
       sdk: flutter
     http: ^1.1.0
     cupertino_icons: ^1.0.2

Ejecuta el comando para instalar las dependencias:

.. code-block:: bash

   flutter pub get

Paso 2: Configuración de la Base de Datos
==========================================

2.1 Crear la Base de Datos
---------------------------

Ejecuta el siguiente script SQL en tu servidor MySQL:

.. code-block:: sql

   CREATE DATABASE crud_flutter;
   USE crud_flutter;

   CREATE TABLE usuarios (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nombre VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   -- Insertar datos de prueba
   INSERT INTO usuarios (nombre, email, password) VALUES
   ('Juan Pérez', 'juan@email.com', 'password123'),
   ('María García', 'maria@email.com', 'password456'),
   ('Carlos López', 'carlos@email.com', 'password789');

2.2 Configurar la API PHP
--------------------------

Crea el archivo ``api/config.php``:

.. code-block:: php

   <?php
   header('Content-Type: application/json');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Content-Type');

   // Configuración de la base de datos
   $host = 'localhost';
   $dbname = 'crud_flutter';
   $username = 'root';
   $password = '';

   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) {
       die(json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]));
   }
   ?>

Crea el archivo ``api/api.php``:

.. code-block:: php

   <?php
   require_once 'config.php';

   $method = $_SERVER['REQUEST_METHOD'];
   $action = $_GET['action'] ?? '';

   switch($method) {
       case 'GET':
           if($action === 'usuarios') {
               obtenerUsuarios();
           }
           break;
       
       case 'POST':
           $data = json_decode(file_get_contents('php://input'), true);
           if($action === 'crear') {
               crearUsuario($data);
           } elseif($action === 'update') {
               actualizarUsuario($data);
           } elseif($action === 'delete') {
               eliminarUsuario($data);
           }
           break;
   }

   function obtenerUsuarios() {
       global $pdo;
       try {
           $stmt = $pdo->query("SELECT id, nombre, email FROM usuarios ORDER BY id DESC");
           $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
           echo json_encode($usuarios);
       } catch(PDOException $e) {
           echo json_encode(['error' => $e->getMessage()]);
       }
   }

   function crearUsuario($data) {
       global $pdo;
       try {
           $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
           $stmt->execute([$data['nombre'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
           echo json_encode(['success' => true, 'message' => 'Usuario creado correctamente']);
       } catch(PDOException $e) {
           echo json_encode(['success' => false, 'error' => $e->getMessage()]);
       }
   }

   function actualizarUsuario($data) {
       global $pdo;
       try {
           $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
           $stmt->execute([$data['nombre'], $data['email'], $data['id']]);
           echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
       } catch(PDOException $e) {
           echo json_encode(['success' => false, 'error' => $e->getMessage()]);
       }
   }

   function eliminarUsuario($data) {
       global $pdo;
       try {
           $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
           $stmt->execute([$data['id']]);
           echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente']);
       } catch(PDOException $e) {
           echo json_encode(['success' => false, 'error' => $e->getMessage()]);
       }
   }
   ?>

Paso 3: Crear el Modelo de Datos
=================================

3.1 Modelo Usuario
------------------

Crea el archivo ``lib/models/usuario.dart``:

.. code-block:: dart

   class Usuario {
     final int id;
     final String nombre;
     final String email;

     Usuario({
       required this.id,
       required this.nombre,
       required this.email,
     });

     factory Usuario.fromJson(Map<String, dynamic> json) {
       return Usuario(
         id: int.parse(json['id'].toString()),
         nombre: json['nombre'] ?? '',
         email: json['email'] ?? '',
       );
     }

     Map<String, dynamic> toJson() {
       return {
         'id': id,
         'nombre': nombre,
         'email': email,
       };
     }
   }

Paso 4: Implementar los Servicios de API
=========================================

4.1 Servicio de Usuario
-----------------------

Crea el archivo ``lib/services/usuario_service.dart``:

.. code-block:: dart

   import 'dart:convert';
   import 'package:http/http.dart' as http;
   import '../models/usuario.dart';

   class UsuarioService {
     // Cambia esta URL por la de tu servidor local
     static const String baseUrl = 'http://localhost/crud_flutter/api/api.php';

     // Obtener todos los usuarios
     static Future<List<Usuario>> obtenerUsuarios() async {
       try {
         final response = await http.get(
           Uri.parse('$baseUrl?action=usuarios'),
           headers: {'Content-Type': 'application/json'},
         );

         if (response.statusCode == 200) {
           final List<dynamic> jsonData = json.decode(response.body);
           return jsonData.map((json) => Usuario.fromJson(json)).toList();
         } else {
           throw Exception('Error al cargar usuarios: ${response.statusCode}');
         }
       } catch (e) {
         throw Exception('Error de conexión: $e');
       }
     }

     // Crear nuevo usuario
     static Future<bool> crearUsuario(String nombre, String email, String password) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?action=crear'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({
             'nombre': nombre,
             'email': email,
             'password': password,
           }),
         );

         if (response.statusCode == 200) {
           final responseData = json.decode(response.body);
           return responseData['success'] == true;
         }
         return false;
       } catch (e) {
         throw Exception('Error al crear usuario: $e');
       }
     }

     // Actualizar usuario existente
     static Future<bool> actualizarUsuario(int id, String nombre, String email) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?action=update'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({
             'id': id,
             'nombre': nombre,
             'email': email,
           }),
         );

         if (response.statusCode == 200) {
           final responseData = json.decode(response.body);
           return responseData['success'] == true;
         }
         return false;
       } catch (e) {
         throw Exception('Error al actualizar usuario: $e');
       }
     }

     // Eliminar usuario
     static Future<bool> eliminarUsuario(int id) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?action=delete'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({'id': id}),
         );

         if (response.statusCode == 200) {
           final responseData = json.decode(response.body);
           return responseData['success'] == true;
         }
         return false;
       } catch (e) {
         throw Exception('Error al eliminar usuario: $e');
       }
     }
   }

Paso 5: Implementar la Interfaz de Usuario
===========================================

5.1 Estructura Principal
------------------------

El archivo ``lib/main.dart`` contiene toda la lógica de la interfaz. Aquí están los componentes principales:

**Componentes Clave:**

1. **Lista de Usuarios**: Muestra todos los usuarios en una tabla
2. **Botones de Acción**: Editar y eliminar para cada usuario
3. **Diálogos Modales**: Para crear, editar y confirmar eliminación
4. **Manejo de Estados**: Loading, error y datos vacíos

5.2 Funcionalidades Implementadas
---------------------------------

**A. Mostrar Lista de Usuarios**

.. code-block:: dart

   Future<void> cargarUsuarios() async {
     try {
       setState(() {
         isLoading = true;
         error = null;
       });
       
       final usuariosObtenidos = await UsuarioService.obtenerUsuarios();
       
       setState(() {
         usuarios = usuariosObtenidos;
         isLoading = false;
       });
     } catch (e) {
       setState(() {
         error = e.toString();
         isLoading = false;
       });
     }
   }

**B. Crear Nuevo Usuario**

La función ``_mostrarDialogoCrear()`` presenta un formulario modal con:

- Campo de nombre
- Campo de email
- Campo de contraseña
- Validación de campos obligatorios
- Llamada al servicio de creación

**C. Editar Usuario Existente**

La función ``_mostrarDialogoEditar(Usuario usuario)`` permite:

- Pre-llenar campos con datos actuales
- Modificar nombre y email
- Validar cambios antes de enviar
- Actualizar la lista tras edición exitosa

**D. Eliminar Usuario**

La función ``_confirmarEliminar(Usuario usuario)`` implementa:

- Diálogo de confirmación con advertencia
- Información del usuario a eliminar
- Botones de cancelar y confirmar
- Eliminación y actualización de lista

Paso 6: Características de la Interfaz
=======================================

6.1 Diseño Responsivo
---------------------

La aplicación incluye:

- **Gradientes de color** para mejor apariencia
- **Cards elevadas** para separar contenido
- **Iconos intuitivos** para cada acción
- **Colores semánticos** (azul para editar, rojo para eliminar)
- **Feedback visual** con SnackBars

6.2 Manejo de Estados
--------------------

La aplicación maneja tres estados principales:

1. **Cargando**: Muestra un indicador de progreso
2. **Error**: Muestra mensaje de error con opción de reintentar
3. **Datos**: Muestra la tabla de usuarios o mensaje de lista vacía

6.3 Validaciones
----------------

- **Campos obligatorios**: Todos los campos deben completarse
- **Formato de email**: Validación automática del teclado
- **Confirmación de eliminación**: Previene eliminaciones accidentales

Paso 7: Pruebas y Depuración
=============================

7.1 Configurar el Servidor Local
--------------------------------

1. Inicia tu servidor web (XAMPP, WAMP, etc.)
2. Coloca los archivos PHP en la carpeta ``htdocs`` o ``www``
3. Verifica que la base de datos esté funcionando
4. Prueba la API directamente en el navegador:
   ``http://localhost/crud_flutter/api/api.php?action=usuarios``

7.2 Ejecutar la Aplicación Flutter
----------------------------------

.. code-block:: bash

   # Para web (recomendado para desarrollo)
   flutter run -d chrome

   # Para dispositivo móvil
   flutter run

7.3 Verificar Funcionalidades
-----------------------------

**Lista de Verificación:**

☐ La aplicación carga y muestra usuarios existentes
☐ El botón "+" abre el diálogo de crear usuario
☐ Se pueden crear nuevos usuarios correctamente
☐ Los botones de editar abren el diálogo con datos pre-llenados
☐ Las ediciones se guardan y reflejan en la lista
☐ Los botones de eliminar muestran confirmación
☐ Las eliminaciones se ejecutan correctamente
☐ Los mensajes de error se muestran apropiadamente
☐ El botón de refrescar actualiza la lista

Paso 8: Solución de Problemas Comunes
======================================

8.1 Errores de Conexión
-----------------------

**Problema**: "Error de conexión" o "Failed to load"

**Soluciones**:

1. Verificar que el servidor web esté ejecutándose
2. Comprobar la URL en ``UsuarioService.baseUrl``
3. Asegurar que los headers CORS estén configurados en PHP
4. Verificar la conexión a la base de datos

8.2 Errores de CORS
-------------------

**Problema**: "CORS policy" error en navegador

**Solución**: Asegurar que el archivo ``config.php`` incluya:

.. code-block:: php

   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Content-Type');

8.3 Errores de Base de Datos
----------------------------

**Problema**: Errores SQL o conexión a BD

**Soluciones**:

1. Verificar credenciales en ``config.php``
2. Asegurar que la base de datos existe
3. Comprobar que la tabla ``usuarios`` esté creada
4. Verificar permisos del usuario de BD

Paso 9: Extensiones y Mejoras
==============================

9.1 Funcionalidades Adicionales
-------------------------------

**Posibles mejoras**:

- Búsqueda y filtrado de usuarios
- Paginación para listas grandes
- Validación de email en tiempo real
- Campos adicionales (teléfono, dirección, etc.)
- Autenticación y autorización
- Carga de imágenes de perfil

9.2 Optimizaciones de Rendimiento
---------------------------------

- Implementar caché local
- Lazy loading para listas grandes
- Optimización de consultas SQL
- Compresión de respuestas API

9.3 Mejoras de UX/UI
--------------------

- Animaciones de transición
- Temas claro/oscuro
- Internacionalización (i18n)
- Accesibilidad mejorada

Conclusión
==========

Has completado exitosamente la implementación de un sistema CRUD completo en Flutter con las siguientes características:

✅ **Interfaz moderna y responsiva**
✅ **Operaciones CRUD completas** (Crear, Leer, Actualizar, Eliminar)
✅ **Conexión robusta con API PHP**
✅ **Manejo adecuado de errores**
✅ **Validaciones de formularios**
✅ **Feedback visual para el usuario**

Este proyecto te proporciona una base sólida para desarrollar aplicaciones móviles más complejas con Flutter y APIs backend.

Recursos Adicionales
====================

- `Documentación oficial de Flutter <https://flutter.dev/docs>`_
- `Guía de HTTP requests en Dart <https://dart.dev/tutorials/server/httpserver>`_
- `Documentación de PHP PDO <https://www.php.net/manual/en/book.pdo.php>`_
- `Mejores prácticas de Flutter <https://flutter.dev/docs/perf/best-practices>`_

**¡Felicitaciones por completar este tutorial!** 🎉

---

*Tutorial creado para fines educativos - Desarrollo de Aplicaciones Móviles*