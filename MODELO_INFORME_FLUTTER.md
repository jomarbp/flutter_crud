# MODELO DE INFORME – Flutter + API PHP (CRUD Full Stack)

> Usa este modelo como guía. Reemplaza los marcadores [ ] con tu contenido.

---

## CARÁTULA

- Universidad/Institución: [Nombre]
- Facultad/Escuela: [Nombre]
- Asignatura: Desarrollo de Aplicaciones Móviles
- Título del informe: Arquitectura y Buenas Prácticas para un CRUD en Flutter con API REST en PHP
- Estudiante: [Nombre completo]
- Código/ID: [Código]
- Docente: [Nombre]
- Fecha: [dd/mm/aaaa]
- Evaluación: Examen del Indicador 2

---

## ÍNDICE

1. Resumen Ejecutivo
2. Introducción
3. Marco Teórico
4. Análisis Comparativo de Gestión de Estado
5. Integración HTTP y Backend PHP
6. Seguridad, Rendimiento y UX
7. Pruebas y CI/CD
8. Conclusiones y Recomendaciones
9. Referencias Bibliográficas (APA 7ma)
10. Anexos (opcional)

---

## 1. Resumen Ejecutivo (400-500 palabras)

- Objetivo y alcance del trabajo.
- Metodología general aplicada.
- Hallazgos clave (arquitectura, estado, HTTP, seguridad, rendimiento, UX).
- Recomendaciones prácticas para el proyecto.

---

## 2. Introducción (600-800 palabras)

- Contexto del problema: CRUD móvil con Flutter y API PHP.
- Planteamiento del problema y preguntas de investigación.
- Objetivos: general y específicos.
- Metodología y fuentes consultadas (breve).
- Estructura del documento.

---

## 3. Marco Teórico (1,200-1,500 palabras)

- Arquitecturas móviles, principios SOLID, separación por capas.
- Reactividad en Flutter: widgets, estado, streams/futures.
- Patrones relevantes: Repository, DTO/mapper, DI.
- Protocolos HTTP y contratos JSON; códigos y errores.

---

## 4. Análisis Comparativo de Gestión de Estado (1,200-1,500 palabras)

- Candidatos: Provider, Riverpod, BLoC/Cubit, GetX.
- Criterios: complejidad, escalabilidad, testabilidad, curva de aprendizaje, comunidad.
- Tabla comparativa requerida:

| Librería | Patrón | Ventajas | Limitaciones | Escenarios Recomendados |
|---------|--------|----------|--------------|--------------------------|
| Provider | InheritedWidget | | | |
| Riverpod | Sin contexto | | | |
| BLoC/Cubit | Streams | | | |
| GetX | Reactivo | | | |

- Recomendación para este proyecto `lib/` y justificación.

---

## 5. Integración HTTP y Backend PHP (1,200-1,500 palabras)

- Clientes evaluados: `http`, Dio, Chopper (interceptores, retries, cancelación, serialización).
- Diseño de endpoints en `backend/`: rutas, verbos, códigos, estructura de respuesta.
- Paginación, filtrado, ordenamiento; versionado de API.
- Tabla comparativa de clientes HTTP:

| Cliente | Interceptores | Retries | Cancelación | Serialización |
|--------|---------------|---------|-------------|---------------|
| http | | | | |
| Dio | | | | |
| Chopper | | | | |

- Manejo de errores: timeouts, reintentos, backoff, fallbacks.

---

## 6. Seguridad, Rendimiento y UX (1,000-1,200 palabras)

- Validación de entrada en Flutter y `backend/`.
- Manejo de tokens y almacenamiento seguro; evitar fugas en logs.
- CORS y controles mínimos en PHP (rate limiting básico, sanitización).
- Rendimiento: listas grandes, memoización, evitar renders innecesarios.
- UX: estados de carga, vacíos, errores; accesibilidad e i18n/l10n.
- Matriz de técnicas de integración:

| Técnica | Efectividad | Complejidad | Impacto en UX | Casos de Uso |
|--------|-------------|-------------|---------------|--------------|
| Cache de respuestas | | | | |
| Errores centralizados | | | | |
| Validación formularios | | | | |
| Paginación/Infinite scroll | | | | |
| Offline-first | | | | |

---

## 7. Pruebas y CI/CD (600-800 palabras)

- Estrategia de pruebas en Flutter: unit, widget, integration.
- Pruebas de API: Insomnia (recomendado) o Postman/newman, PHPUnit, o scripts equivalentes.
- Cobertura mínima esperada y automatización básica.
- Evidencias: reportes breves, capturas o enlaces.

---

## 8. Conclusiones y Recomendaciones (500-700 palabras)

- Resumen de hallazgos y respuesta a objetivos.
- Decisiones recomendadas: arquitectura, estado, cliente HTTP.
- Riesgos y trabajos futuros.
- Guía de adopción para este repositorio (`lib/`, `backend/`).

---

## 9. Referencias Bibliográficas (APA 7ma)

- Mínimo 15 fuentes (académicas, técnicas oficiales, casos, complementarias).
- Formato consistente APA 7ma.

Ejemplo de formato (APA 7ma):
- Apellido, N. (Año). Título del artículo. Revista, volumen(número), páginas. `https://doi.org/...`

---

## 10. Anexos (opcional)

- Capturas/GIF del flujo CRUD (mín. 3).
- Colección Insomnia (recomendada) o Postman, o scripts.
- Estructura del proyecto `lib/` y `backend/`.
- Enlaces a repositorio y rama utilizada.

---

## ORIENTACIONES PARA EL COMPONENTE PRÁCTICO

- Requisitos mínimos del módulo CRUD en `lib/` y endpoints en `backend/` según consigna.
- Entregables prácticos: código, README de ejecución, pruebas (≥5), evidencias visuales.

---

## NOTAS SOBRE EVALUACIÓN

- Este trabajo corresponde al Examen del Indicador 2.
- Las exposiciones orales se realizarán la próxima semana (fechas a confirmar).
- Considera la rúbrica específica de exposiciones incluida en la consigna.
