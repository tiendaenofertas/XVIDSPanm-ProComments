<?php
/**
 * Plantilla de Tarjeta de Entrada (Grid Card)
 */

// 1. Obtener opciones
$card_style = get_theme_mod( 'blog_card_style', 'basic' ); // 'basic' o 'overlay'
$show_date  = get_theme_mod( 'blog_show_date', true );
$show_desc  = get_theme_mod( 'blog_show_excerpt', true );

// 2. Clases dinámicas
$article_classes = array( 'post-card', 'style-' . $card_style );
if ( ! has_post_thumbnail() ) { $article_classes[] = 'no-thumbnail'; }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?>>
    
    <a href="<?php the_permalink(); ?>" class="post-card-link" aria-hidden="true" tabindex="-1">
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-card-image">
                <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
                
                <?php if ( $card_style === 'overlay' ) : ?>
                    <div class="card-overlay-gradient"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="post-card-content">
            
            <?php 
            // CORTAR EL TÍTULO A 15 CARACTERES
            $titulo_original = get_the_title();
            $titulo_corto = ( mb_strlen( $titulo_original ) > 15 ) ? mb_substr( $titulo_original, 0, 15 ) . '...' : $titulo_original;
            ?>
            <h2 class="entry-title card-title" title="<?php echo esc_attr( $titulo_original ); ?>">
                <?php echo esc_html( $titulo_corto ); ?>
            </h2>

            <?php if ( $show_date ) : ?>
                <div class="entry-meta card-meta">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                </div>
            <?php endif; ?>

        </div>
    </a>
</article>