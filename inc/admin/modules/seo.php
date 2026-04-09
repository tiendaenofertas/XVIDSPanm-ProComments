<?php
/**
 * Módulo: MÁS POTENCIA (Herramientas y Recomendaciones)
 */

// 1. REGISTRO DE OPCIONES (Para evitar errores en la BD, se mantiene el registro vacío)
if ( ! function_exists( 'mi_tema_register_seo_settings' ) ) {
    function mi_tema_register_seo_settings() {
        register_setting( 'mainter_seo_group', 'mainter_seo_options', 'mi_tema_seo_sanitize' );
    }
    add_action( 'admin_init', 'mi_tema_register_seo_settings' );
}

// 2. RENDERIZADO VISUAL (Interfaz de Usuario)
if ( ! function_exists( 'mi_tema_render_seo_content' ) ) {
    function mi_tema_render_seo_content() {
        ?>
        <style>
            .plugins-mini-grid { 
                display: grid; 
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
                gap: 15px; 
                margin-top: 15px; 
            }
            .plugin-mini-card {
                background: #f8f9fa; border: 1px solid #e2e4e7; border-radius: 6px;
                padding: 12px; display: flex; align-items: center; gap: 12px;
                text-decoration: none; transition: all 0.2s ease;
            }
            .plugin-mini-card:hover {
                background: #fff; border-color: #007cba; transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }
            .p-icon { font-size: 24px; line-height: 1; }
            .p-info h5 { margin: 0; font-size: 14px; color: #1d2327; font-weight: 600; }
            .p-info span { font-size: 11px; color: #646970; text-transform: uppercase; letter-spacing: 0.5px; }
        </style>

        <h3>🚀 MÁS POTENCIA</h3>
        <p class="description" style="margin-bottom: 15px;">Potencia tu sitio con nuestras herramientas recomendadas para mejorar tu rendimiento y monetización:</p>
        
        <div class="plugins-mini-grid">
            <a href="https://www.xvidspro.com/" target="_blank" class="plugin-mini-card">
                <span class="p-icon">🚀</span>
                <div class="p-info">
                    <h5>Xvidspro</h5>
                    <span>RECOMENDADO</span>
                </div>
            </a>

            <a href="https://xvidspro.com/xvidspam" target="_blank" class="plugin-mini-card">
                <span class="p-icon">🔥</span>
                <div class="p-info">
                    <h5>xvidspam</h5>
                    <span>CLÁSICO</span>
                </div>
            </a>

            <a href="https://www.xvidspro.com/" target="_blank" class="plugin-mini-card">
                <span class="p-icon">▶️</span>
                <div class="p-info">
                    <h5>Xvidspro Player</h5>
                    <span>LIGERO</span>
                </div>
            </a>
        </div>
        <?php
    }
}

// 3. SANITIZACIÓN (Vacía porque ya no guardamos opciones aquí)
if ( ! function_exists( 'mi_tema_seo_sanitize' ) ) {
    function mi_tema_seo_sanitize( $input ) {
        return array();
    }
}
