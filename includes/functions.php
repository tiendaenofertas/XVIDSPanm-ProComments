<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =========================================================================
// 1. REGISTRAR SHORTCODE OPCIONAL [xvidspro_comentarios]
// =========================================================================
add_shortcode( 'xvidspro_comentarios', 'xvidspro_render_comentarios_shortcode' );

function xvidspro_render_comentarios_shortcode() {
    $post_id = get_the_ID();

    // Si no hay ID (ej. estamos fuera del Loop), no mostrar nada
    if ( ! $post_id ) {
        return '';
    }

    ob_start();

    echo '<div class="xvidspro-procomments-wrapper">';
    
    // Imprimir el Formulario
    if ( function_exists( 'xvidspro_mostrar_formulario_comentarios' ) ) {
        echo xvidspro_mostrar_formulario_comentarios( $post_id );
    }

    // Imprimir la Lista de Comentarios
    if ( function_exists( 'xvidspro_mostrar_lista_comentarios' ) ) {
        echo xvidspro_mostrar_lista_comentarios( $post_id );
    }

    echo '</div>';

    return ob_get_clean();
}

// =========================================================================
// 2. INTEGRACIÓN AUTOMÁTICA (Compatible con WP-Script)
// =========================================================================
add_filter( 'comments_template', 'xvidspro_reemplazar_comentarios_nativos' );

function xvidspro_reemplazar_comentarios_nativos( $theme_template ) {
    // Verificar si estamos en una publicación individual (post, o custom post type como 'video')
    if ( is_singular() ) {
        // Comprobamos si el administrador tiene activados los comentarios en nuestro panel
        $estado_actual = get_option( 'xvidspro_comments_status', 'on' );
        
        if ( $estado_actual === 'on' ) {
            // CORRECCIÓN AQUÍ: Usamos XVIDSPAM_PATH para enlazar con el nuevo nombre del plugin
            return XVIDSPAM_PATH . 'templates/comments-area.php';
        }
    }
    
    // Si no es un post individual o están desactivados, devolvemos la plantilla original
    return $theme_template;
}

// =========================================================================
// 4. BLINDAJE TOTAL: DESACTIVAR EL MOTOR NATIVO DE COMENTARIOS
// =========================================================================

// 1. Cerrar la posibilidad de comentar en el motor nativo
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// 2. Bloquear cualquier intento de envío directo a wp-comments-post.php
add_action( 'check_comment_flood', 'xvidspro_bloquear_motor_nativo' );
add_action( 'pre_comment_on_post', 'xvidspro_bloquear_motor_nativo' );

function xvidspro_bloquear_motor_nativo() {
    wp_die( 'El sistema de comentarios nativo está desactivado. Use el formulario oficial de XvidsPam.' );
}

// 3. Desactivar los endpoints de comentarios en la REST API (Ruta que usan muchos bots modernos)
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/comments'] ) ) {
        unset( $endpoints['/wp/v2/comments'] );
    }
    if ( isset( $endpoints['/wp/v2/comments/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/comments/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});
