<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function xvidspro_mostrar_formulario_comentarios( $post_id ) {
    $estado_actual = get_option( 'xvidspro_comments_status', 'on' );
    if ( $estado_actual === 'off' ) return '<p class="xvidspro-closed">Los comentarios están desactivados en este momento.</p>';

    $btn_bg    = get_option( 'xvidspro_btn_bg', '#9bd62c' );
    $btn_text  = get_option( 'xvidspro_btn_text', '#111111' );
    $btn_hover = get_option( 'xvidspro_btn_hover', '#a8e533' );

    $num1 = rand( 1, 9 );
    $num2 = rand( 1, 9 );
    $suma = $num1 + $num2;
    $hash_seguro = wp_hash( $suma . 'xvidspro_seguridad', 'nonce' );

    ob_start(); ?>
    
    <style>
        #xvidspro_submit_btn { background-color: <?php echo esc_attr($btn_bg); ?> !important; color: <?php echo esc_attr($btn_text); ?> !important; }
        #xvidspro_submit_btn:hover { background-color: <?php echo esc_attr($btn_hover); ?> !important; }
    </style>

    <div id="xvidspro-comments-section" class="xvidspro-form-wrapper">
        <h3 class="xvidspro-title">Deja tu comentario</h3>
        
        <form id="xvidspro-comment-form">
            <input type="hidden" id="xvidspro_post_id" value="<?php echo esc_attr( $post_id ); ?>">
            <input type="hidden" id="xvidspro_time_start" value="<?php echo time(); ?>">
            <input type="text" id="xvidspro_website_url" style="display:none !important;" tabindex="-1" autocomplete="off">
            <input type="hidden" id="xvidspro_human_token" value="">
            
            <div class="xvidspro-form-row">
                <div class="xvidspro-form-group">
                    <label for="xvidspro_name">Nombre</label>
                    <input type="text" id="xvidspro_name" required placeholder="Escribe tu nombre">
                </div>
            </div>

            <div class="xvidspro-form-group" style="position: relative;">
                <label for="xvidspro_comment">Comentario</label>
                <textarea id="xvidspro_comment" required rows="3" placeholder="Únete a la conversación..." maxlength="500"></textarea>
                <div id="xvidspro-char-counter" style="text-align: right; font-size: 0.8rem; color: #888; margin-top: 5px; font-weight: bold;">
                    <span id="xvidspro-char-current">0</span> / 500
                </div>
            </div>

            <div class="xvidspro-form-footer">
                <div class="xvidspro-captcha-box">
                    <label for="xvidspro_captcha_answer">
                        <span class="xvidspro-robot-icon">🤖</span> Resuelve: <strong><?php echo $num1; ?> + <?php echo $num2; ?></strong>
                    </label>
                    <input type="number" id="xvidspro_captcha_answer" required placeholder="=">
                    <input type="hidden" id="xvidspro_captcha_hash" value="<?php echo esc_attr( $hash_seguro ); ?>">
                </div>

                <div class="xvidspro-submit-box">
                    <button type="submit" id="xvidspro_submit_btn">Publicar</button>
                </div>
            </div>
            
            <div id="xvidspro-form-response"></div>
        </form>
    </div>

    <?php
    return ob_get_clean();
}