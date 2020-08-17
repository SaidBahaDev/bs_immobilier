<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package immobilier
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">

    <?php
        
    $image = get_field('bs_image');

    if( !empty($image) ): 

        // vars
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];

        // thumbnail
        $size = 'large';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];


    endif; ?>
    
    <div class="row">
    <!-- contenu de propriete -->
        <div class="col-8">
            <div class="row bs_box_shadow p-3 mb-4">
                <div class="col-12 p-0">
                    <!-- Image -->
                    <div class="row">
                        <div class="col">
                            <img class="card-img-top"src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-3">
                    <!-- Titre et Prix -->
                    <div class="row justify-content-between">
                        <div class="col">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </div>
                        <div class="col">
                        <div class="prix-propriete"><?php echo number_format_i18n(get_field('bs_prix'))?> $</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Caracteristique -->
            <div class="row bs_box_shadow p-3 mb-4">
                <div class="col-12 mt-2">
                    <h5 class="pb-2">Caractéristiques</h5>
                    <div class="row justify-content-between caract mb-2">
                        <div class="col">
                            <i class="fas fa-map-marker-alt"> </i><?=" " .get_field('bs_ville')?>
                        </div>
                        <div class="col">
                            <i class="fab fa-buffer"></i> <?=" " .get_field('bs_nombre_etage')?> étage<?= get_field('bs_nombre_etage') > 1?"s":"" ?>
                        </div>
                        <div class="col">
                            <i class="fas fa-bed"></i> <?=" " .get_field('bs_nombre_de_chambre')?> chambre<?= get_field('bs_nombre_de_chambre') > 1?"s":"" ?>
                        </div>
                        <div class="col">
                        <i class="fas fa-th-large"></i> <?=" " .get_field('bs_nombre_de_pieces')?> pièce<?= get_field('bs_nombre_de_chambre') > 1?"s":"" ?>
                        </div>
                    </div>
                    <div class="row justify-content-between caract mb-2">
                        <div class="col">
                            <i class="fas fa-border-style"></i> Batiment <?=" " .get_field('bs_dimension_du_batiment')?> m<sup>2</sup>
                        </div>
                        <div class="col">
                            <i class="far fa-square"></i> Terrain <?=" " .get_field('bs_dimension_du_terrain')?> m<sup>2</sup>
                        </div>
                        <div class="col">
                            <i class="fas fa-calendar-alt"></i> <?=" " .get_field('bs_annee_de_construction')?>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bs_box_shadow p-3 mb-4">
                <div class="col">
                <h5 class="pb-2">Description</h5>
                <?php
                    the_content( sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bs_immobilier' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ) );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bs_immobilier' ),
                        'after'  => '</div>',
                    ) );
                ?>

                </div>
            </div>
        </div>
        <!-- bare laterale -->
        <div class="col-4">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div>
    </div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bs_immobilier_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
