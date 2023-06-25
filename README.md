# Plugin de Muestra de HEX y RGBA

## Descripción

Este plugin de WordPress permite mostrar el valor HEX y su conversión a RGBA de una variable específica. Utiliza un shortcode llamado `[mostrar-rgba]` para generar la salida.

## Funcionalidades

### Extracción de valor de variable desde un archivo CSS

El plugin extrae el valor de una variable específica desde un archivo CSS ubicado en la carpeta de activos (`assets`) del plugin Bricksforge. El archivo CSS se obtiene mediante la función `file_get_contents()` y la URL del archivo.

### Conversión de HEX a RGBA

El plugin incluye una función llamada `convertir_hex_a_rgba()` que convierte un valor HEX dado en su equivalente RGBA. Dependiendo del parámetro opcional `$porcentaje_transparencia`, la función puede devolver el valor de transparencia en porcentaje.

### Shortcode para mostrar RGBA y HEX

El plugin registra un shortcode llamado `[mostrar-rgba]` que acepta un parámetro `nombre` para especificar el nombre de la variable. Al usar el shortcode, el plugin extrae el valor de la variable del archivo CSS y muestra el valor RGBA y HEX resultante.

## Uso

Para mostrar el valor RGBA y HEX de una variable específica, puedes utilizar el siguiente shortcode en cualquier lugar que se admita el contenido de WordPress:

```
[mostrar-rgba nombre="nombre_variable"]
```

Reemplaza `"nombre_variable"` por el nombre real de la variable que deseas obtener.

## Autor

Este plugin fue creado por Francesc Xavier Escandell y puedes obtener más información sobre él en su sitio web [escandell.cat](https://escandell.cat).
