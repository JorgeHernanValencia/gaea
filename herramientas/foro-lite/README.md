# 🗣️ Foro Lite — GAEA/LOGOS v0.1

Foro Lite es una herramienta experimental y minimalista para discusión web desarrollada dentro del marco del proyecto **GAEA (Gobierno Algorítmico Ético y Autónomo)** y su laboratorio **LOGOS**.

Diseñada para ser **fácil de instalar, portable y sin dependencias complejas**, esta versión permite que cualquier persona pueda instalar y mantener un foro básico en su propio servidor web sin necesidad de configurar bases de datos externas como MySQL.

---

## 🔧 Características principales

- ✔️ Registro de publicaciones inmediato
- ✔️ No requiere instalación adicional
- ✔️ Soporte para SQLite (si está disponible)
- ✔️ Fallback automático a archivo `posts.json` si SQLite no está habilitado
- ✔️ Interfaz ultra ligera y adaptable
- ✔️ Ideal para discusiones temáticas, foros descentralizados o espacios comunitarios rápidos

---

## 🚀 Instalación

1. **Descarga o clona** este repositorio o simplemente los documentos del directorio foro-lite:
2. Sube los archivos del foro al servidor que tenga soporte para PHP (>= 7).
3. Asegúrate de tener permisos de escritura en el directorio (necesario para crear posts.json o el archivo de base de datos SQLite).
4. Abre el archivo index.php desde tu navegador.

> No necesitas ninguna base de datos ni configuración adicional.


---

📂 Estructura del Proyecto

/foro-Lite/
├── index.php         # Archivo principal del foro
├── posts.json        # (opcional) Archivo de almacenamiento en modo fallback
├── style.css         # Estilos básicos
├── README.md         # Este archivo


---

📌 Uso

Escribe un nombre y un mensaje.
Haz clic en “Publicar”.
Tu mensaje se mostrará en el foro automáticamente.

---

🧪 Estado actual
> Versión: 0.1 — Prototipo funcional


Esta es una versión temprana pensada para ser base de experimentación. Se espera agregar:

🧑 Registro de usuarios
🧵 Soporte para hilos o categorías
🛡️ Moderación básica
🌐 Sincronización entre nodos (foro descentralizado)


---

🧭 Sobre GAEA y LOGOS

GAEA es una propuesta abierta para una nueva forma de gobernanza apoyada en algoritmos auditables y principios éticos definidos colectivamente.
LOGOS es su laboratorio público de reflexión, diseño y testeo de herramientas de participación, justicia algorítmica y deliberación cívica.

Más información en: https://gaea.fadcoad.com


---

🤝 Contribuciones

Este foro es parte de un proyecto abierto. Puedes:
Reportar errores
Sugerir mejoras
Crear tu propia versión

¡Toda participación es bienvenida!


---

📄 Licencia

Este proyecto se distribuye bajo la Licencia MIT.
