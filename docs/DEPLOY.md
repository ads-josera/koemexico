# Deploy de Proyecto Drupal

Esta guía sirve como procedimiento estándar para desplegar proyectos Drupal en un servidor de producción.

## Principio general

- **Código y estructura:** se actualizan desde Git.
- **Configuración sensible del servidor:** no se sobrescribe.
- **Archivos subidos por usuarios:** no se sobrescriben.

---

# Nunca versionar ni sobrescribir

Los siguientes archivos y directorios deben permanecer propios de cada entorno (producción, staging o desarrollo):

```text
web/sites/default/settings.php
web/sites/default/settings.local.php
web/sites/default/settings.ddev.php
web/sites/default/services.yml
web/sites/default/files/
```

Tampoco versionar:

```text
*.sql
*.sql.gz
*.zip
*.tar.gz
logs/
backups/
dumps/
```

---

# Flujo de trabajo local

Verificar cambios:

```bash
git status
```

Agregar archivos:

```bash
git add .
```

Crear commit:

```bash
git commit -m "Descripción del cambio"
```

Enviar cambios:

```bash
git push origin main
```

---

# Antes de desplegar

Ejecutar actualizaciones de Drupal:

```bash
ddev exec drush updb -y
ddev exec drush cr
```

Si el proyecto utiliza configuración exportada:

```bash
ddev exec drush cex -y
```

Verificar que el sitio funcione correctamente antes del despliegue.

---

# Despliegue en servidor

Entrar al directorio del proyecto:

```bash
cd /ruta/del/proyecto
```

Actualizar código:

```bash
git pull origin main
```

Instalar dependencias:

```bash
composer install --no-dev --optimize-autoloader
```

Ejecutar actualizaciones:

```bash
php vendor/bin/drush updb -y
```

Importar configuración (si aplica):

```bash
php vendor/bin/drush cim -y
```

Limpiar caché:

```bash
php vendor/bin/drush cr
```

Si el servidor utiliza otro binario PHP, reemplazar `php` por el correspondiente.

---

# Primera instalación en servidor

1. Crear la base de datos.
2. Crear o conservar:

```text
web/sites/default/settings.php
```

3. Configurar el **document root** apuntando a:

```text
web/
```

4. Clonar el repositorio:

```bash
git clone <REPOSITORIO> .
```

5. Instalar dependencias:

```bash
composer install --no-dev --optimize-autoloader
```

6. No reemplazar el `settings.php` existente.

7. Verificar permisos de escritura únicamente para:

```text
web/sites/default/files
```

---

# Configuración del entorno

Las credenciales nunca deben almacenarse en Git.

Configurar en el servidor:

- Base de datos
- SMTP
- APIs (OpenAI, Twilio, etc.)
- Claves privadas
- Variables de entorno

---

# Si el servidor no permite Composer

Generar un build local con las dependencias instaladas y subir únicamente el artefacto generado.

Excluir siempre:

```text
web/sites/default/settings.php
web/sites/default/settings.local.php
web/sites/default/settings.ddev.php
web/sites/default/services.yml
web/sites/default/files/
```

---

# Dependencias del sistema

Si el proyecto utiliza OCR, RAG o procesamiento de documentos, verificar que el servidor tenga instaladas las herramientas necesarias.

Ejemplo para PDF:

```text
pdftotext (poppler-utils)
```

Comprobar disponibilidad:

```bash
which pdftotext
```

---

# Checklist de despliegue

Antes:

- [ ] Commit realizado
- [ ] Push a la rama principal
- [ ] `drush updb`
- [ ] `drush cr`
- [ ] `drush cex` (si aplica)

Servidor:

- [ ] `git pull`
- [ ] `composer install`
- [ ] `drush updb`
- [ ] `drush cim` (si aplica)
- [ ] `drush cr`

Después:

- [ ] Verificar login
- [ ] Verificar formularios
- [ ] Verificar correos
- [ ] Verificar cron
- [ ] Revisar Reporte de Estado