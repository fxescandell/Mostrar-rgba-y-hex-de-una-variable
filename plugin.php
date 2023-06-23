<?php
/*
Plugin Name: Muestra el HEX y el RGBA de una variable
Plugin URI: https://escandell.cat
Description: Muestra el HEX de una variable y su conversión a RGBA mediante el siguiente shortcode [mostrar-rgba nombre="mi-clase"].<br>
El valor de la clase la extrae del css que está ubicado en la carpeta de assets de brickforge que se usa para personalizar bricks
Version: 1.0
Author: Francesc Xavier Escandell
Author URI: https://escandell.cat
*/




function mostrar_rgba($atts) {
    // Obtener el nombre de la variable del shortcode
    $nombre_variable = $atts['nombre'];

    // Obtener el valor de la variable en el archivo CSS
    $url_css = 'https://escandell.local/wp-content/plugins/bricksforge/assets/classes/custom.css';
    $contenido_css = file_get_contents($url_css, false, stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]));
    preg_match("/$nombre_variable: (.*?);/", $contenido_css, $matches);
    $valor_hex = isset($matches[1]) ? $matches[1] : '';

    // Convertir el valor HEX a RGBA con porcentaje de transparencia
    $valor_rgba = convertir_hex_a_rgba($valor_hex, true);

    // Mostrar el valor RGBA y HEX
    $resultado = "<strong>RGBA:</strong> $valor_rgba <br> <strong>HEX:</strong> $valor_hex";

    // Mostrar el resultado en un elemento de texto
    return "<span>$resultado</span>";
}

// Agregar el shortcode
add_shortcode('mostrar-rgba', 'mostrar_rgba');

// Función para convertir HEX a RGBA
function convertir_hex_a_rgba($hex, $porcentaje_transparencia = false) {
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) === 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        $alpha = 0;
    } elseif (strlen($hex) === 6) {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $alpha = 1;
    } elseif (strlen($hex) === 8) {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $alpha_hex = substr($hex, 6, 2);
        $alpha = round(hexdec($alpha_hex) / 255, 2);
    } else {
        // Valor HEX inválido, devolver valor por defecto
        return '0,0,0,1';
    }

    if ($porcentaje_transparencia) {
        $alpha *= 100;
        $alpha = round($alpha, 2) . '%';
    }

    $rgba = "$r, $g, $b, $alpha";

    return $rgba;
}
