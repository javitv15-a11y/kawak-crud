# KAWAK CRUD – Prueba Técnica Práctica 🧩

Sistema CRUD de documentos con autenticación, búsqueda, creación, edición, eliminación y recálculo automático de código.  
Desarrollado como parte del proceso de selección **Ingeniero de Soluciones – KAWAK**.

---

## Comenzando 🚀

Estas instrucciones te permitirán obtener una copia del proyecto funcionando en tu máquina local para propósitos de desarrollo y pruebas.  
Mira la sección **Despliegue 📦** para conocer cómo implementarlo en un entorno productivo.

---

### Pre-requisitos 📋

Asegúrate de tener instalados los siguientes componentes:

- **PHP 7.4+** (funciona también con PHP 8.x)
- **Apache** con el módulo `mod_rewrite` habilitado  
- **MySQL 5.7+ / 8.x**
- **Composer** (opcional)
- **Laragon / XAMPP** (recomendado)
- Configuración UTF-8 (`utf8mb4`)

---

### Instalación 🔧

1. Clona el repositorio:
   ```bash
   C:\laragon\www> git clone https://github.com/javitv15-a11y/kawak-crud.git
   ```
2. Accede al proyecto:
   ```bash
   cd kawak-crud
   ```
3. (Opcional) Instala dependencias:
   ```bash
   composer install
   composer dump-autoload
   ```
4. Crea la base de datos:
   ```sql
   CREATE DATABASE kawak_docs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
5. Importa los archivos:
   - `sql/DDL.sql` → estructura  
   - `sql/DML.sql` → datos base (procesos y tipos)
6. Configura los archivos:
   - `app/Config/database.php` → credenciales MySQL
   - `app/Config/app.php` → usuario y contraseña del login
7. Inicia Apache y MySQL en Laragon.
8. Abre tu navegador y visita:
   ```
   http://localhost/kawak-crud/public/
   ```
---

### Ejemplo de login 🔐

- **Usuario:** `admin`  
- **Contraseña:** `1234`

---

## Ejecutando las pruebas ⚙️

### Pruebas funcionales 🔩

- **Login:** acceso correcto e incorrecto  
- **CRUD Documentos:** crear, editar, eliminar, listar  
- **Búsqueda:** por nombre, código, tipo o proceso  
- **Redirección:** evita volver a `/login` si ya hay sesión  
- **Regla de negocio:** recalcula el código (`TIPO–PROCESO–N`) al cambiar tipo o proceso  

### Pruebas de estilo de código ⌨️

- PSR-4 (autoload con Composer)  
- Arquitectura MVC  
- Código documentado y segmentado  
- Escapado de HTML con `htmlspecialchars`  

---

## Despliegue 📦

1. Copia el proyecto al servidor (Apache).  
2. Configura `RewriteBase` en `public/.htaccess`.  
3. Asegura carpetas sensibles:
   - `.htaccess` en `/app`, `/vendor`, `/sql` con:
     ```
     Require all denied
     ```
4. Usa HTTPS si el entorno productivo lo soporta.  

---

## Construido con 🛠️

* [PHP](https://www.php.net/) – Lenguaje principal  
* [MySQL](https://www.mysql.com/) – Base de datos  
* [Laragon](https://laragon.org/) – Entorno local  
* [Composer](https://getcomposer.org/) – Autoload y dependencias  
* [HTML/CSS/JS] – Interfaz y vistas  
* [Apache] – Servidor web  

---

## Contribuyendo 🖇️

Este proyecto fue realizado como **prueba técnica individual**, pero se pueden enviar sugerencias o mejoras mediante **pull requests**.  

---

## Wiki 📖

No aplica.  
La documentación funcional se encuentra directamente en este archivo README.md.

---

## Versionado 📌

Se sigue el esquema [SemVer](http://semver.org/) de versionado semántico.  
Versión actual: **1.0.0 (Entrega técnica KAWAK)**.

---

## Autores ✒️

* **Javier Torres Vergara** – *Desarrollo completo, documentación y QA funcional*  
  [@javitv15](https://github.com/javitv15-a11y)

---

## Licencia 📄

Este proyecto se entrega con fines de evaluación técnica.  
Puede ser reutilizado con fines educativos y no comerciales.

---

## Expresiones de Gratitud 🎁

* Agradecimientos a **KAWAK** por la oportunidad y por promover el talento con propósito 💚  
* Inspirado por el enfoque “trabajo consciente” y las buenas prácticas de ingeniería.  
* ¡Y gracias al café ☕ por mantener el foco durante el desarrollo!

---

⌨️ con ❤️ por [Javier Torres Vergara](https://github.com/javitv15-a11y) 😊
