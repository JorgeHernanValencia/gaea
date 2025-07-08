# 🗣️ Foro Lite — GAEA/LOGOS v1.0

**Foro Lite** es una herramienta ligera, extensible y autoalojable para crear espacios de discusión web en proyectos comunitarios, sin depender de redes sociales ni plataformas cerradas. Forma parte de **GAEA** (Gobierno Algorítmico Ético y Autónomo) y su laboratorio **LOGOS**.

> Esta es la versión 1.0 del foro, y marca una actualización importante respecto al prototipo inicial (v0.1).


## ✨ Novedades en la versión 1.0

- 🧑‍💻 **Sistema de cuentas de usuario** con nombre, contraseña e imagen de perfil  
- 🛠️ **Almacenamiento híbrido:** soporte para SQLite o JSON según disponibilidad  
- 🗂️ **Estructura en hilos:** permite responder a otros comentarios con indentación  
- 🖼️ **Avatares personalizados** visibles junto a los mensajes  
- 🧾 **Compatibilidad con Markdown** (negrilla, enlaces, listas y más)  
- 🔒 **Validaciones mejoradas y más seguras**  
- 🚫 **Prevención de colisiones en escritura concurrente**  
- 🌐 **Más claridad visual y estructura adaptable**


## 🔧 Características principales

✔️ Ultra ligero: solo PHP puro, sin frameworks  
✔️ No requiere MySQL ni instalación compleja  
✔️ Markdown básico para enriquecer los comentarios  
✔️ Respaldo automático a JSON si SQLite no está habilitado  
✔️ Código abierto y fácil de adaptar  
✔️ Estructura simple y transparente  
✔️ Ideal para laboratorios cívicos, comunidades autónomas o foros descentralizados


## 🚀 Instalación

1. **Descarga** este repositorio o solo el directorio `foro-lite-1.0/`  
2. **Sube** los archivos a tu servidor con soporte PHP (versión 7.4 o superior)  
3. **Asegura permisos de escritura** sobre el directorio del foro  
   - Si SQLite está disponible, se usará automáticamente  
   - Si no, se usará `posts.json` como alternativa  
4. Abre `index.php` desde el navegador.  
5. Regístrate con un nombre, imagen y contraseña. ¡Y listo!

(Asegurate de cambiar en el documento enviar_confirmacion_edicion.php el link por la dirección en dónde estará ubicado el proyecto en tu web).

## 💬 ¿Cómo usar Markdown?

Puedes usar **Markdown** para dar estilo a tus comentarios:

- **Negrita:** `**así**` → **así**  
- *Cursiva:* `*así*` → *así*  
- [Enlace]: `[Texto](https://ejemplo.com)` → [Texto](https://ejemplo.com)  
- `Código`: rodeado por acentos graves ( ` )  
- Listas:
  - `- punto 1`
  - `- punto 2`

Markdown se procesa de forma segura para evitar inyecciones o código malicioso.

---

## 📂 Estructura del proyecto

/foro-lite-1.0/ ├── index.php         # Página principal del foro ├── guardar.php       # Procesa y guarda los comentarios ├── login.php         # Inicio de sesión ├── registro.php      # Registro de usuarios ├── logout.php        # Cierre de sesión ├── usuarios.json     # Datos de los usuarios registrados ├── posts.json        # Almacenamiento alternativo si no hay SQLite ├── foro.db           # Base de datos SQLite (si se usa) ├── estilo.css        # Estilos básicos del foro ├── init.php          # Configura la conexión según SQLite/JSON ├── README.md         # Este documento

---

## 📌 Estado del proyecto

**Versión actual:** 1.0 — Estable y funcional

**Pendientes para futuras versiones:**

- 📁 Categorías temáticas o etiquetas  
- 👥 Menciones a otras personas  
- 🔔 Notificaciones internas  
- 🌱 Integración opcional con IPFS u otras redes descentralizadas


## 🧭 Sobre GAEA y LOGOS

**GAEA** es una propuesta abierta para nuevos modelos de gobernanza ética, auditables y transparentes.  
**LOGOS** es su laboratorio de herramientas cívicas, deliberativas y simbióticas, donde se diseñan y prueban tecnologías accesibles para comunidades.

Más información: https://gaea.fadcoad.com  
Repositorio principal: https://github.com/JorgeHernanValencia/gaea


## 🤝 Contribuciones

Este proyecto es completamente abierto. Puedes:

- Reportar errores  
- Sugerir nuevas funciones  
- Usarlo y adaptarlo en tu comunidad  
- Participar en las [Discusiones del proyecto en GitHub](https://github.com/JorgeHernanValencia/gaea/discussions)

**Toda participación es bienvenida.**

## 📄 Licencia

Distribuido bajo la Licencia MIT.  
Eres libre de usarlo, modificarlo y compartirlo. Solo mantén la atribución.
