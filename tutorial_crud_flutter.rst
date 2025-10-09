===============================================================================
Tutorial: Agregar Funcionalidades de Editar y Eliminar a tu Lista de Usuarios
===============================================================================

:Autor: Instructor de Desarrollo Móvil
:Fecha: Diciembre 2024
:Versión: 1.0
:Tema: Desarrollo de aplicaciones Flutter con PHP API

.. contents:: Tabla de Contenidos
   :depth: 3
   :local:

Introducción
============

Este tutorial te guiará paso a paso para **agregar las funcionalidades de editar y eliminar** a tu aplicación Flutter que ya tiene implementada la funcionalidad de **listar usuarios** en una tabla.

**Punto de Partida**

Asumimos que ya tienes:

- ✅ Una aplicación Flutter funcionando
- ✅ Una tabla que muestra usuarios (ID, Nombre, Email)
- ✅ Conexión a base de datos MySQL
- ✅ API PHP básica para obtener usuarios
- ✅ Modelo ``Usuario`` y servicio ``UsuarioService`` básicos

**¿Qué vamos a agregar?**

- 🔧 **Botones de Editar y Eliminar** en cada fila de la tabla
- 🔧 **Diálogo de edición** para modificar usuarios existentes
- 🔧 **Diálogo de confirmación** para eliminar usuarios
- 🔧 **Métodos en el servicio** para actualizar y eliminar
- 🔧 **Endpoints PHP** para las operaciones UPDATE y DELETE
- 🔧 **Botón flotante** para crear nuevos usuarios

**Prerrequisitos**

- Aplicación Flutter con lista de usuarios funcionando
- Conocimientos básicos de Flutter y Dart
- Servidor web con PHP y MySQL funcionando

Paso 1: Actualizar la API PHP para Soportar UPDATE y DELETE
===========================================================

**¿Qué vamos a hacer?**

Primero necesitamos agregar los endpoints para actualizar y eliminar usuarios en nuestro archivo PHP.

**Archivo: api.php (Modificaciones)**

Si tu archivo ``api.php`` actual solo tiene el método ``read``, necesitas agregar los casos para ``update`` y ``delete``:

.. code-block:: php

   <?php
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
   require "conexion.php";
   
   // Debug: Log all incoming data
   error_log("POST data: " . print_r($_POST, true));
   error_log("Raw input: " . file_get_contents('php://input'));
   error_log("Content-Type: " . (isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'not set'));
   
   // Leer la acción enviada desde Flutter
   $action = $_POST['action'] ?? '';
   
   // Debug: Log the action received
   error_log("Action received: " . $action);
   
   switch ($action) {
       // CREATE
       case 'create':
           $nombre = $_POST['nombre'];
           $email = $_POST['email'];
           $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
           $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
           $stmt->execute([
               ':nombre' => $nombre,
               ':email' => $email,
               ':password' => $password
           ]);
           echo json_encode(["status" => "ok", "message" => "Usuario creado"]);
           break;
       // READ
       case 'read':
           $stmt = $pdo->query("SELECT id, nombre, email FROM usuarios");
           $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
           echo json_encode($usuarios);
           break;
       // UPDATE
       case 'update':
           $id = $_POST['id'];
           $nombre = $_POST['nombre'];
           $email = $_POST['email'];
           $stmt = $pdo->prepare("UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id");
           $stmt->execute([
               ':nombre' => $nombre,
               ':email' => $email,
               ':id' => $id
           ]);
           echo json_encode(["status" => "ok", "message" => "Usuario actualizado"]);
           break;
       // DELETE
       case 'delete':
           $id = $_POST['id'];
           $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
           $stmt->execute([':id' => $id]);
           echo json_encode(["status" => "ok", "message" => "Usuario eliminado"]);
           break;
       default:
           echo json_encode(["status" => "error", "message" => "Acción no válida"]);
           break;
   }
   ?>


**✅ Verificación del Paso 1**

- [ ] Agregaste los casos ``update`` y ``delete`` a tu ``api.php``
- [ ] Probaste que tu API sigue funcionando para listar usuarios

Paso 2: Actualizar el Servicio UsuarioService
==============================================

**¿Qué vamos a hacer?**

Ahora necesitamos agregar los métodos ``actualizarUsuario`` y ``eliminarUsuario`` a nuestro servicio Flutter.

**Archivo: lib/services/usuario_service.dart (Modificaciones)**

Si tu servicio actual solo tiene el método ``obtenerUsuarios``, necesitas agregar estos métodos:

.. code-block:: dart

   import 'dart:convert';
   import 'package:http/http.dart' as http;
   import '../models/usuario.dart';

   class UsuarioService {
     // Cambia esta URL por la de tu servidor
     static const String baseUrl = 'http://localhost/tu_proyecto/api.php';

     // Tu método existente para obtener usuarios
     static Future<List<Usuario>> obtenerUsuarios() async {
       try {
         final response = await http.get(
           Uri.parse('$baseUrl?operation=read'),
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

     // ¡NUEVOS MÉTODOS QUE DEBES AGREGAR!

     // Método para actualizar un usuario
     static Future<bool> actualizarUsuario(int id, String nombre, String email) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?operation=update'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({
             'id': id,
             'nombre': nombre,
             'email': email,
           }),
         );

         if (response.statusCode == 200) {
           final Map<String, dynamic> jsonData = json.decode(response.body);
           return jsonData['success'] ?? false;
         } else {
           return false;
         }
       } catch (e) {
         print('Error al actualizar usuario: $e');
         return false;
       }
     }

     // Método para eliminar un usuario
     static Future<bool> eliminarUsuario(int id) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?operation=delete'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({
             'id': id,
           }),
         );

         if (response.statusCode == 200) {
           final Map<String, dynamic> jsonData = json.decode(response.body);
           return jsonData['success'] ?? false;
         } else {
           return false;
         }
       } catch (e) {
         print('Error al eliminar usuario: $e');
         return false;
       }
     }

     // Método para crear un usuario (opcional, si no lo tienes)
     static Future<bool> crearUsuario(String nombre, String email, String password) async {
       try {
         final response = await http.post(
           Uri.parse('$baseUrl?operation=create'),
           headers: {'Content-Type': 'application/json'},
           body: json.encode({
             'nombre': nombre,
             'email': email,
             'password': password,
           }),
         );

         if (response.statusCode == 200) {
           final Map<String, dynamic> jsonData = json.decode(response.body);
           return jsonData['success'] ?? false;
         } else {
           return false;
         }
       } catch (e) {
         print('Error al crear usuario: $e');
         return false;
       }
     }
   }

**✅ Verificación del Paso 2**

- [ ] Agregaste el método ``actualizarUsuario`` a tu servicio
- [ ] Agregaste el método ``eliminarUsuario`` a tu servicio
- [ ] Verificaste que la URL base apunta a tu servidor

Paso 3: Agregar Columna de Acciones a la Tabla
===============================================

**¿Qué vamos a hacer?**

Ahora vamos a modificar tu tabla existente para agregar una columna "Acciones" con botones de editar y eliminar.

**Archivo: lib/main.dart (Modificación de la tabla)**

**ANTES:** Tu tabla probablemente se ve así:

.. code-block:: dart

   // En tu método build(), dentro del Table para los headers
   TableRow(
     children: [
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text('ID', style: TextStyle(fontWeight: FontWeight.bold)),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text('Nombre', style: TextStyle(fontWeight: FontWeight.bold)),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text('Email', style: TextStyle(fontWeight: FontWeight.bold)),
       ),
       // ¡FALTA LA COLUMNA DE ACCIONES!
     ],
   ),

**DESPUÉS:** Agrega la columna de acciones:

.. code-block:: dart

   // En tu método build(), dentro del Table para los headers
   TableRow(
     children: [
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           'ID',
           style: const TextStyle(
             color: Colors.white,
             fontWeight: FontWeight.bold,
             fontSize: 16,
           ),
           textAlign: TextAlign.center,
         ),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           'Nombre',
           style: const TextStyle(
             color: Colors.white,
             fontWeight: FontWeight.bold,
             fontSize: 16,
           ),
           textAlign: TextAlign.center,
         ),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           'Email',
           style: const TextStyle(
             color: Colors.white,
             fontWeight: FontWeight.bold,
             fontSize: 16,
           ),
           textAlign: TextAlign.center,
         ),
       ),
       // ¡NUEVA COLUMNA DE ACCIONES!
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           'Acciones',
           style: const TextStyle(
             color: Colors.white,
             fontWeight: FontWeight.bold,
             fontSize: 16,
           ),
           textAlign: TextAlign.center,
         ),
       ),
     ],
   ),

**Y en las filas de datos:**

**ANTES:** Tus filas probablemente se ven así:

.. code-block:: dart

   // En tu ListView.builder, dentro del Table para cada usuario
   TableRow(
     children: [
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(usuario.id.toString()),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(usuario.nombre),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(usuario.email),
       ),
       // ¡FALTAN LOS BOTONES DE ACCIÓN!
     ],
   ),

**DESPUÉS:** Agrega los botones de acción:

.. code-block:: dart

   // En tu ListView.builder, dentro del Table para cada usuario
   TableRow(
     children: [
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           usuario.id.toString(),
           style: const TextStyle(fontWeight: FontWeight.w500),
           textAlign: TextAlign.center,
         ),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           usuario.nombre,
           style: const TextStyle(fontWeight: FontWeight.w500),
           textAlign: TextAlign.center,
         ),
       ),
       Padding(
         padding: const EdgeInsets.all(16.0),
         child: Text(
           usuario.email,
           style: const TextStyle(color: Colors.grey),
           textAlign: TextAlign.center,
         ),
       ),
       // ¡NUEVOS BOTONES DE ACCIÓN!
       Padding(
         padding: const EdgeInsets.all(8.0),
         child: Row(
           mainAxisAlignment: MainAxisAlignment.center,
           children: [
             IconButton(
               icon: const Icon(Icons.edit, color: Colors.blue),
               onPressed: () => _mostrarDialogoEditar(usuario),
               tooltip: 'Editar',
             ),
             IconButton(
               icon: const Icon(Icons.delete, color: Colors.red),
               onPressed: () => _confirmarEliminar(usuario),
               tooltip: 'Eliminar',
             ),
           ],
         ),
       ),
     ],
   ),

**✅ Verificación del Paso 3**

- [ ] Agregaste la columna "Acciones" al header de tu tabla
- [ ] Agregaste los botones de editar y eliminar a cada fila
- [ ] Los botones llaman a ``_mostrarDialogoEditar`` y ``_confirmarEliminar``

Paso 4: Implementar el Diálogo de Edición
==========================================

**¿Qué vamos a hacer?**

Ahora vamos a crear la función ``_mostrarDialogoEditar`` que se ejecuta cuando el usuario presiona el botón de editar.

**Archivo: lib/main.dart (Agregar método)**

Agrega este método a tu clase ``_UsuariosPageState``:

.. code-block:: dart

   Future<void> _mostrarDialogoEditar(Usuario usuario) async {
     final TextEditingController nombreController = TextEditingController(text: usuario.nombre);
     final TextEditingController emailController = TextEditingController(text: usuario.email);

     return showDialog<void>(
       context: context,
       barrierDismissible: false, // El usuario debe presionar un botón para cerrar
       builder: (BuildContext context) {
         return AlertDialog(
           title: const Text(
             'Editar Usuario',
             style: TextStyle(fontWeight: FontWeight.bold),
           ),
           content: SingleChildScrollView(
             child: ListBody(
               children: <Widget>[
                 TextField(
                   controller: nombreController,
                   decoration: const InputDecoration(
                     labelText: 'Nombre',
                     border: OutlineInputBorder(),
                     prefixIcon: Icon(Icons.person),
                   ),
                 ),
                 const SizedBox(height: 16),
                 TextField(
                   controller: emailController,
                   decoration: const InputDecoration(
                     labelText: 'Email',
                     border: OutlineInputBorder(),
                     prefixIcon: Icon(Icons.email),
                   ),
                   keyboardType: TextInputType.emailAddress,
                 ),
               ],
             ),
           ),
           actions: <Widget>[
             TextButton(
               child: const Text('Cancelar'),
               onPressed: () {
                 Navigator.of(context).pop();
               },
             ),
             ElevatedButton(
               child: const Text('Guardar'),
               onPressed: () async {
                 if (nombreController.text.isNotEmpty && emailController.text.isNotEmpty) {
                   try {
                     final success = await UsuarioService.actualizarUsuario(
                       usuario.id,
                       nombreController.text,
                       emailController.text,
                     );
                     
                     if (success) {
                       Navigator.of(context).pop();
                       ScaffoldMessenger.of(context).showSnackBar(
                         const SnackBar(
                           content: Text('Usuario actualizado correctamente'),
                           backgroundColor: Colors.green,
                         ),
                       );
                       cargarUsuarios(); // Recargar la lista
                     } else {
                       ScaffoldMessenger.of(context).showSnackBar(
                         const SnackBar(
                           content: Text('Error al actualizar usuario'),
                           backgroundColor: Colors.red,
                         ),
                       );
                     }
                   } catch (e) {
                     ScaffoldMessenger.of(context).showSnackBar(
                       SnackBar(
                         content: Text('Error: $e'),
                         backgroundColor: Colors.red,
                       ),
                     );
                   }
                 } else {
                   ScaffoldMessenger.of(context).showSnackBar(
                     const SnackBar(
                       content: Text('Por favor complete todos los campos'),
                       backgroundColor: Colors.orange,
                     ),
                   );
                 }
               },
             ),
           ],
         );
       },
     );
   }

**✅ Verificación del Paso 4**

- [ ] Agregaste el método ``_mostrarDialogoEditar`` a tu clase
- [ ] El método crea controladores con los valores actuales del usuario
- [ ] El diálogo tiene campos para nombre y email
- [ ] El botón "Guardar" llama a ``UsuarioService.actualizarUsuario``
- [ ] Se muestra un SnackBar con el resultado de la operación

Paso 5: Implementar el Diálogo de Confirmación de Eliminación
=============================================================

**¿Qué vamos a hacer?**

Ahora vamos a crear la función ``_confirmarEliminar`` que se ejecuta cuando el usuario presiona el botón de eliminar.

**Archivo: lib/main.dart (Agregar método)**

Agrega este método a tu clase ``_UsuariosPageState``:

.. code-block:: dart

   Future<void> _confirmarEliminar(Usuario usuario) async {
     return showDialog<void>(
       context: context,
       barrierDismissible: false,
       builder: (BuildContext context) {
         return AlertDialog(
           title: const Text(
             'Confirmar Eliminación',
             style: TextStyle(fontWeight: FontWeight.bold),
           ),
           content: SingleChildScrollView(
             child: ListBody(
               children: <Widget>[
                 const Icon(
                   Icons.warning,
                   color: Colors.orange,
                   size: 48,
                 ),
                 const SizedBox(height: 16),
                 Text(
                   '¿Estás seguro de que deseas eliminar al usuario "${usuario.nombre}"?',
                   textAlign: TextAlign.center,
                 ),
                 const SizedBox(height: 8),
                 const Text(
                   'Esta acción no se puede deshacer.',
                   style: TextStyle(
                     color: Colors.red,
                     fontWeight: FontWeight.bold,
                   ),
                   textAlign: TextAlign.center,
                 ),
               ],
             ),
           ),
           actions: <Widget>[
             TextButton(
               child: const Text('Cancelar'),
               onPressed: () {
                 Navigator.of(context).pop();
               },
             ),
             ElevatedButton(
               style: ElevatedButton.styleFrom(
                 backgroundColor: Colors.red,
                 foregroundColor: Colors.white,
               ),
               child: const Text('Eliminar'),
               onPressed: () async {
                 try {
                   final success = await UsuarioService.eliminarUsuario(usuario.id);
                   
                   if (success) {
                     Navigator.of(context).pop();
                     ScaffoldMessenger.of(context).showSnackBar(
                       const SnackBar(
                         content: Text('Usuario eliminado correctamente'),
                         backgroundColor: Colors.green,
                       ),
                     );
                     cargarUsuarios(); // Recargar la lista
                   } else {
                     ScaffoldMessenger.of(context).showSnackBar(
                       const SnackBar(
                         content: Text('Error al eliminar usuario'),
                         backgroundColor: Colors.red,
                       ),
                     );
                   }
                 } catch (e) {
                   ScaffoldMessenger.of(context).showSnackBar(
                     SnackBar(
                       content: Text('Error: $e'),
                       backgroundColor: Colors.red,
                     ),
                   );
                 }
               },
             ),
           ],
         );
       },
     );
   }

**✅ Verificación del Paso 5**

- [ ] Agregaste el método ``_confirmarEliminar`` a tu clase
- [ ] El diálogo muestra el nombre del usuario a eliminar
- [ ] Hay una advertencia clara sobre que la acción no se puede deshacer
- [ ] El botón "Eliminar" llama a ``UsuarioService.eliminarUsuario``
- [ ] Se muestra un SnackBar con el resultado de la operación

Paso 6: Agregar Botón Flotante para Crear Usuarios (Opcional)
=============================================================

**¿Qué vamos a hacer?**

Como bonus, vamos a agregar un botón flotante para crear nuevos usuarios.

**Archivo: lib/main.dart (Modificar el Scaffold)**

En tu método ``build()``, agrega el ``floatingActionButton`` al ``Scaffold``:

.. code-block:: dart

   @override
   Widget build(BuildContext context) {
     return Scaffold(
       appBar: AppBar(
         title: const Text('Lista de Usuarios'),
         // ... tu código existente del AppBar
       ),
       body: Container(
         // ... tu código existente del body
       ),
       // ¡AGREGAR ESTE BOTÓN FLOTANTE!
       floatingActionButton: FloatingActionButton(
         onPressed: _mostrarDialogoCrear,
         backgroundColor: Colors.blue[700],
         foregroundColor: Colors.white,
         child: const Icon(Icons.add),
         tooltip: 'Agregar Usuario',
       ),
     );
   }

**Y agregar el método para crear usuarios:**

.. code-block:: dart

   Future<void> _mostrarDialogoCrear() async {
     final TextEditingController nombreController = TextEditingController();
     final TextEditingController emailController = TextEditingController();
     final TextEditingController passwordController = TextEditingController();

     return showDialog<void>(
       context: context,
       barrierDismissible: false,
       builder: (BuildContext context) {
         return AlertDialog(
           title: const Text(
             'Crear Nuevo Usuario',
             style: TextStyle(fontWeight: FontWeight.bold),
           ),
           content: SingleChildScrollView(
             child: ListBody(
               children: <Widget>[
                 TextField(
                   controller: nombreController,
                   decoration: const InputDecoration(
                     labelText: 'Nombre',
                     border: OutlineInputBorder(),
                     prefixIcon: Icon(Icons.person),
                   ),
                 ),
                 const SizedBox(height: 16),
                 TextField(
                   controller: emailController,
                   decoration: const InputDecoration(
                     labelText: 'Email',
                     border: OutlineInputBorder(),
                     prefixIcon: Icon(Icons.email),
                   ),
                   keyboardType: TextInputType.emailAddress,
                 ),
                 const SizedBox(height: 16),
                 TextField(
                   controller: passwordController,
                   decoration: const InputDecoration(
                     labelText: 'Contraseña',
                     border: OutlineInputBorder(),
                     prefixIcon: Icon(Icons.lock),
                   ),
                   obscureText: true,
                 ),
               ],
             ),
           ),
           actions: <Widget>[
             TextButton(
               child: const Text('Cancelar'),
               onPressed: () {
                 Navigator.of(context).pop();
               },
             ),
             ElevatedButton(
               child: const Text('Crear'),
               onPressed: () async {
                 if (nombreController.text.isNotEmpty && 
                     emailController.text.isNotEmpty && 
                     passwordController.text.isNotEmpty) {
                   try {
                     final success = await UsuarioService.crearUsuario(
                       nombreController.text,
                       emailController.text,
                       passwordController.text,
                     );
                     
                     if (success) {
                       Navigator.of(context).pop();
                       ScaffoldMessenger.of(context).showSnackBar(
                         const SnackBar(
                           content: Text('Usuario creado correctamente'),
                           backgroundColor: Colors.green,
                         ),
                       );
                       cargarUsuarios();
                     } else {
                       ScaffoldMessenger.of(context).showSnackBar(
                         const SnackBar(
                           content: Text('Error al crear usuario'),
                           backgroundColor: Colors.red,
                         ),
                       );
                     }
                   } catch (e) {
                     ScaffoldMessenger.of(context).showSnackBar(
                       SnackBar(
                         content: Text('Error: $e'),
                         backgroundColor: Colors.red,
                       ),
                     );
                   }
                 } else {
                   ScaffoldMessenger.of(context).showSnackBar(
                     const SnackBar(
                       content: Text('Por favor complete todos los campos'),
                       backgroundColor: Colors.orange,
                     ),
                   );
                 }
               },
             ),
           ],
         );
       },
     );
   }

**✅ Verificación del Paso 6**

- [ ] Agregaste el ``FloatingActionButton`` al ``Scaffold``
- [ ] Agregaste el método ``_mostrarDialogoCrear``
- [ ] El diálogo tiene campos para nombre, email y contraseña
- [ ] El botón "Crear" llama a ``UsuarioService.crearUsuario``

Paso 7: Probar la Aplicación
=============================

**¿Qué vamos a hacer?**

Ahora vamos a probar que todas las funcionalidades funcionen correctamente.

**Ejecutar la aplicación:**

.. code-block:: bash

   flutter run

**Lista de verificación de funcionalidades:**

**✅ Funcionalidades a probar:**

1. **Listar usuarios:**
   - [ ] La tabla muestra todos los usuarios de la base de datos
   - [ ] Se muestran las columnas: ID, Nombre, Email, Acciones

2. **Editar usuario:**
   - [ ] Al presionar el botón de editar (lápiz azul) se abre el diálogo
   - [ ] Los campos se llenan con los datos actuales del usuario
   - [ ] Al guardar, se actualiza la información en la base de datos
   - [ ] La tabla se actualiza automáticamente
   - [ ] Se muestra un mensaje de confirmación

3. **Eliminar usuario:**
   - [ ] Al presionar el botón de eliminar (basura roja) se abre el diálogo de confirmación
   - [ ] Se muestra el nombre del usuario a eliminar
   - [ ] Al confirmar, el usuario se elimina de la base de datos
   - [ ] La tabla se actualiza automáticamente
   - [ ] Se muestra un mensaje de confirmación

4. **Crear usuario (si implementaste el paso 6):**
   - [ ] Al presionar el botón flotante (+) se abre el diálogo de creación
   - [ ] Se pueden llenar todos los campos
   - [ ] Al crear, se agrega el usuario a la base de datos
   - [ ] La tabla se actualiza automáticamente
   - [ ] Se muestra un mensaje de confirmación

**Posibles errores y soluciones:**

**Error de conexión a la API:**
- Verifica que tu servidor web esté ejecutándose
- Verifica que la URL en ``UsuarioService`` sea correcta
- Verifica que el archivo ``api.php`` esté en la ubicación correcta

**Error de CORS:**
- Asegúrate de que tu ``api.php`` tenga los headers de CORS correctos

**Error de base de datos:**
- Verifica que la base de datos ``crud_flutter`` exista
- Verifica que la tabla ``usuarios`` tenga las columnas correctas
- Verifica las credenciales de conexión en ``api.php``

Resumen de lo que Agregaste
===========================

**🎉 ¡Felicitaciones!** Has agregado exitosamente las funcionalidades de editar y eliminar a tu aplicación Flutter.

**Resumen de cambios realizados:**

1. **API PHP:** Agregaste los endpoints ``update`` y ``delete``
2. **Servicio Flutter:** Agregaste los métodos ``actualizarUsuario`` y ``eliminarUsuario``
3. **Interfaz de usuario:** Agregaste la columna "Acciones" con botones de editar y eliminar
4. **Diálogos:** Implementaste diálogos para editar y confirmar eliminación
5. **Funcionalidad extra:** Agregaste un botón flotante para crear usuarios

**Funcionalidades que ahora tienes:**

- ✅ **CREATE:** Crear nuevos usuarios
- ✅ **READ:** Listar usuarios en una tabla
- ✅ **UPDATE:** Editar usuarios existentes
- ✅ **DELETE:** Eliminar usuarios con confirmación

**Próximos pasos sugeridos:**

1. **Validación:** Agregar validación de email y campos obligatorios
2. **Búsqueda:** Implementar un campo de búsqueda para filtrar usuarios
3. **Paginación:** Agregar paginación para manejar muchos usuarios
4. **Diseño:** Mejorar el diseño visual de la aplicación
5. **Seguridad:** Implementar autenticación y autorización

¡Tu aplicación CRUD está completa y funcional! 🚀
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
