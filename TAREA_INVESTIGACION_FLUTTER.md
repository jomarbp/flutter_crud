# 🧭 TAREA DE INVESTIGACIÓN: Flutter + API PHP (CRUD Full Stack)
## Análisis de Arquitectura, Buenas Prácticas y Entrega de un Módulo CRUD

---

## 📋 **INFORMACIÓN GENERAL**

**Asignatura:** Desarrollo de Aplicaciones Móviles
**Tipo:** Investigación Teórico-Práctica
**Modalidad:** Individual
**Duración:** 3 semanas
**Puntuación:** 20 puntos
**Formato:** Ensayo académico + Demo funcional + Presentación
**Evaluación:** Examen del Indicador 2
**Presentaciones:** Exposiciones la próxima semana

---

## 🎯 **OBJETIVOS DE APRENDIZAJE**

Al completar esta investigación, el estudiante será capaz de:

1. **Analizar** arquitecturas y patrones de estado en Flutter orientados a CRUD
2. **Diseñar** una integración robusta entre `lib/` (Flutter) y `backend/` (API PHP)
3. **Aplicar** prácticas de seguridad del lado del cliente y del backend
4. **Optimizar** rendimiento, manejo de errores y UX en apps Flutter
5. **Evaluar** trade-offs entre librerías de estado y clientes HTTP
6. **Entregar** un módulo CRUD funcional con pruebas y documentación

---

## 📚 **TEMAS DE INVESTIGACIÓN**

### **TEMA PRINCIPAL:**
**"Arquitectura y Buenas Prácticas para un CRUD en Flutter con API REST en PHP"**

### **SUBTEMAS A INVESTIGAR:**

#### 1. **Arquitectura de Proyecto Flutter (20%)**
- Estructura de carpetas en `lib/` (features-first vs layer-first)
- Separación de capas: presentación, dominio, datos
- Patrón Repository, DTOs y mapeos
- Inyección de dependencias (DI) y modularidad

#### 2. **Gestión de Estado (25%)**
- Comparativa: Provider, Riverpod, BLoC/Cubit, GetX
- Escalabilidad, testabilidad y curva de aprendizaje
- Manejo de formularios, validaciones y reactividad

#### 3. **Integración con API PHP (25%)**
- Clientes HTTP: `http`, Dio, Chopper, Retrofit-like
- Estructura de `backend/` (rutas, controladores, respuestas JSON)
- Paginación, filtrado, ordenamiento
- Errores, timeouts, reintentos, cancelación

#### 4. **Seguridad y Cumplimiento (15%)**
- Validación de entrada en Flutter y en `backend/`
- Manejo de tokens, sesiones y almacenamiento seguro
- Evitar fugas de datos en logs y errores
- CORS, rate limiting y protección básica en PHP

#### 5. **Rendimiento, UX y Accesibilidad (15%)**
- Lazy lists, memoización, evitar renders innecesarios
- Indicadores de carga, estados vacíos y errores
- Accesibilidad (semántica, tamaños, contraste) e i18n/l10n

---

## 📖 **METODOLOGÍA DE INVESTIGACIÓN**

### **Fuentes Requeridas (Mínimo 15 fuentes):**

#### **Fuentes Académicas (40% - 6 fuentes mínimo):**
- Papers sobre arquitectura móvil, patrones de diseño, rendimiento
- Estudios comparativos de gestión de estado en apps reactivas
- Evaluaciones empíricas sobre UX móvil y accesibilidad

#### **Fuentes Técnicas Oficiales (30% - 4-5 fuentes):**
- Documentación oficial Flutter y Dart
- Documentación de Provider, Riverpod, BLoC, GetX
- Documentación de `http`, Dio, Chopper
- Guías de seguridad OWASP Mobile y OWASP API

#### **Casos de Estudio Reales (20% - 3-4 fuentes):**
- Repositorios open-source de CRUD Flutter + PHP
- Post-mortems de fallas de red o seguridad en móviles
- Benchmarks o artículos técnicos de integraciones REST

#### **Fuentes Complementarias (10% - 2 fuentes):**
- Blogs técnicos reconocidos, conferencias, podcasts
- Entrevistas a desarrolladores móviles

---

## 📝 **ESTRUCTURA DEL ENSAYO ACADÉMICO**

### **Extensión:** 6,500 - 8,500 palabras

#### **1. Resumen Ejecutivo (400-500 palabras)**
- Objetivo, alcance y conclusiones clave
- Recomendaciones prácticas para el proyecto

#### **2. Introducción (600-800 palabras)**
- Contexto del CRUD Flutter + PHP
- Planteamiento del problema y objetivos
- Metodología y estructura del documento

#### **3. Marco Teórico (1,200-1,500 palabras)**
- Arquitecturas móviles y principios SOLID
- Reactividad en Flutter y gestión de estado
- Protocolos HTTP, JSON y contratos API

#### **4. Análisis Comparativo de Estado (1,200-1,500 palabras)**
- Provider vs Riverpod vs BLoC vs GetX
- Criterios: complejidad, escalabilidad, testabilidad, comunidad
- Recomendación para el proyecto `lib/`

#### **5. Integración HTTP y Backend PHP (1,200-1,500 palabras)**
- `http` vs Dio vs Chopper: interceptores, retries, cancelación
- Diseño de endpoints en `backend/` (REST, códigos, errores)
- Paginación, filtros y contratos estables

#### **6. Seguridad, Rendimiento y UX (1,000-1,200 palabras)**
- Almacenamiento seguro de tokens y variables sensibles
- Optimización de renders, listas y caché
- Estados de carga, vacíos, errores y accesibilidad

#### **7. Pruebas y CI/CD (600-800 palabras)**
- Unit, widget, integration tests en Flutter
- Tests de API (Postman/newman, PHPUnit, o scripts)
- Automatización básica de calidad

#### **8. Conclusiones y Recomendaciones (500-700 palabras)**
- Hallazgos clave y límites del estudio
- Guía de adopción para este repositorio (`lib/`, `backend/`)

#### **9. Referencias Bibliográficas**
- Formato APA 7ma edición, mínimo 15 fuentes

---

## 🔍 **PREGUNTAS DE INVESTIGACIÓN GUÍA**

### **Principales:**
1. ¿Qué patrón de estado ofrece mejor balance para un CRUD estándar?
2. ¿Cómo estructurar `lib/` para mantener escalabilidad y testabilidad?
3. ¿Qué cliente HTTP es más adecuado considerando robustez y DX?
4. ¿Qué controles mínimos de seguridad deben existir en `backend/`?

### **Específicas:**
1. ¿Cómo manejar reintentos, timeouts y errores del lado de Flutter?
2. ¿Cómo versionar y documentar endpoints para evitar roturas?
3. ¿Qué métricas de rendimiento y UX son críticas en móviles?
4. ¿Qué técnica de cacheo es más efectiva para listas Paginadas?

### **Análisis Crítico:**
1. ¿Cuándo una arquitectura más compleja empeora DX sin ganar calidad?
2. ¿Qué trade-offs existen entre rapidez de entrega vs. mantenibilidad?
3. ¿Cómo balancear seguridad con usabilidad y rendimiento en móvil?

---

## 📊 **ANÁLISIS COMPARATIVO REQUERIDO**

### **Tabla Comparativa de Gestión de Estado (Incluir):**

| Librería | Patrón | Ventajas | Limitaciones | Escenarios Recomendados |
|---------|--------|----------|--------------|--------------------------|
| Provider | InheritedWidget | | | |
| Riverpod | Provider-like sin contexto | | | |
| BLoC/Cubit | Streams + separación | | | |
| GetX | Reactive + utilidades | | | |

### **Tabla Comparativa de Clientes HTTP:**

| Cliente | Interceptores | Retries | Cancelación | Serialización |
|--------|---------------|---------|-------------|---------------|
| `http` | | | | |
| Dio | | | | |
| Chopper | | | | |

### **Matriz de Técnicas de Integración:**

| Técnica | Efectividad | Complejidad | Impacto en UX | Casos de Uso |
|--------|-------------|-------------|---------------|--------------|
| Cache de respuestas | | | | |
| Manejo de errores centralizado | | | | |
| Validación de formularios | | | | |
| Paginación e infinitescroll | | | | |
| Strategy Offline-first | | | | |

---

## 🧪 **COMPONENTE PRÁCTICO (Obligatorio)**

### **Actividad: Módulo CRUD de Productos**

Implementar en `lib/` un módulo CRUD de productos que consuma la API en `backend/`.

#### **Requisitos mínimos:**
- Listado con paginación y búsqueda
- Crear, leer, actualizar y eliminar productos
- Validación de formularios con mensajes claros
- Manejo de estados: cargando, vacío, éxito, error
- Manejo de errores HTTP (4xx/5xx) y reintentos para 5xx
- Cliente HTTP con interceptores para logs y headers
- Gestión de estado con una de: Provider, Riverpod o BLoC
- Serialización de modelos y DTOs
- Arquitectura con capa de datos + repositorio + presentación

#### **Backend (`backend/`):**
- Endpoints REST JSON para productos (index, show, store, update, delete)
- Validación del lado del servidor y códigos de estado correctos
- Respuestas consistentes con `success`, `data`, `message`, `errors`
- Protección básica: sanitización, CORS configurado, rate limit simple opcional

#### **Entregables prácticos:**
- Código funcional en `lib/` y `backend/`
- Archivo `README.md` con instrucciones de ejecución
- Colección Postman/Insomnia o script de pruebas de API
- 5+ pruebas en Flutter (unit/widget/integration)
- 3+ capturas o GIF del flujo CRUD

---

## 🧰 **LINEAMIENTOS TÉCNICOS RECOMENDADOS**

- Estructura sugerida en `lib/`: `features/`, `core/`, `shared/`
- Abstraer el cliente HTTP y centralizar manejo de errores
- Usar `Future`/`Stream` correctamente y cancelar suscripciones
- Serialización explícita y validaciones robustas
- i18n (`intl`) y accesibilidad básica

---

## 📈 **PRESENTACIÓN ORAL**

### **Duración:** 12-15 minutos + 5 minutos preguntas

#### **Estructura de la Presentación:**
1. Contexto y objetivos (2 min)
2. Arquitectura y estado elegidos (4 min)
3. Integración HTTP y manejo de errores (4 min)
4. Seguridad, rendimiento y UX (3 min)
5. Demo breve del CRUD (2 min)
6. Preguntas (5 min)

#### **Recursos Visuales Requeridos:**
- Diapositivas (máx. 12)
- Diagramas de arquitectura
- Capturas/GIF del flujo CRUD
- Fragmentos de código clave

---

## 📊 **CRITERIOS DE EVALUACIÓN**

| Criterio | Puntos | Descripción |
|----------|--------|-------------|
| **Calidad de Investigación** | 5 | Fuentes, profundidad, rigor comparativo |
| **Diseño de Arquitectura** | 4 | Claridad de capas, estado, mantenibilidad |
| **Integración HTTP + Backend** | 4 | Robustez, manejo de errores, consistencia |
| **Seguridad y Rendimiento** | 3 | Prácticas mínimas aplicadas |
| **Pruebas y Documentación** | 2 | Tests, README, evidencias |
| **Presentación** | 2 | Claridad, demo, recursos visuales |
| **TOTAL** | **20** | |

### **Rúbrica resumida:**
- Excelente (18-20): Arquitectura sólida, comparativo profundo, CRUD impecable, buenas pruebas
- Bueno (16-17): Integración correcta, comparativo adecuado, detalles menores por pulir
- Satisfactorio (14-15): Cumple mínimos, análisis y calidad técnica básicos
- Insuficiente (<14): Faltan entregables o rigor técnico

### **Rúbrica específica de exposiciones (Indicador 2, 2 puntos)**
- Claridad y estructura del discurso (0.5): objetivos, hilo lógico, conclusión.
- Dominio técnico y precisión (0.5): explica decisiones, defiende criterios, evita imprecisiones.
- Demostración funcional del CRUD (0.5): flujo completo, manejo de errores visible.
- Recursos visuales y gestión del tiempo (0.3): slides concisas, 12-15 min.
- Manejo de preguntas (0.2): respuestas claras y pertinentes.

> Las exposiciones se realizarán la próxima semana; fechas a confirmar.

---

## 📅 **CRONOGRAMA DE ENTREGA**

| Semana | Actividad | Entregable |
|--------|-----------|------------|
| **Semana 1** | Investigación y diseño | Bibliografía anotada + arquitectura propuesta |
| **Semana 2** | Implementación | CRUD funcional + pruebas iniciales |
| **Semana 3** | Pulido y presentación | Ensayo final + demo + presentación |

### **Fechas Importantes:**
- Entrega bibliografía: [Fecha - Semana 1]
- Entrega implementación: [Fecha - Semana 2]
- Entrega final + Presentación: [Fecha - Semana 3]
- Presentaciones orales: [Próxima semana - fechas a confirmar]

---

## 📚 **RECURSOS RECOMENDADOS**

### **Documentación:**
- Flutter (`https://docs.flutter.dev/`), Dart (`https://dart.dev/`)
- Provider, Riverpod, BLoC, GetX docs
- Paquetes: `http`, Dio, Chopper

### **Buenas Prácticas y Seguridad:**
- OWASP Mobile Top 10, OWASP API Security Top 10
- Guías de arquitectura limpia (Clean Architecture)

### **Herramientas:**
- Postman/Insomnia, Flutter DevTools
- Linter y formatters (analyzer, dartfmt)

---

## ⚠️ **CONSIDERACIONES ÉTICAS**

1. No exponer credenciales en repositorios
2. Usar datos de prueba y respetar privacidad
3. Citar apropiadamente todas las fuentes (APA 7ma)

---

## 🏆 **CRITERIOS DE EXCELENCIA**

- Implementar capa de caché offline-first
- Pipeline básico de CI y cobertura de pruebas >40%
- Manejo avanzado de errores con trazabilidad y códigos propios
- Accesibilidad e i18n completos

---

**¡Éxito en tu investigación y desarrollo! 🚀**

*Este trabajo te permitirá consolidar fundamentos de Flutter, integrar APIs REST en PHP y entregar un módulo CRUD listo para evolucionar en entornos profesionales.*
