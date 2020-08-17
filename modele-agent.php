<?php
/* Template Name: Page Agent */
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package immobilier
 */

get_header();
$image = get_field('bs_image_agent');

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


	<div id="primary" class="content-area container">
		<main id="main" class="site-main">
            <div class="row bs_box_shadow p-3 mt-5 mb-5">
                <div class="col p-0">
                    <img class="image-agent bs_box_shadow p-2"src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
                </div>
                <div class="col">
                    <div>
                        <h1 class="agent-nom"><?=get_field('bs_nom_et_prenom')?></h1>
                    </div>
                    <div>
                        <p><?=get_field('bs_e-mail')?></p>
                    </div>
                    <div>
                        <p><?=get_field('bs_telephone')?></p>
                    </div>
                    <div>
                        <p><?=get_field('bs_site_web')?></p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3>À propos de moi</h3>
                            <p><?=get_field('bs_a_propos_de_moi')?></p>
                        </div>
                    </div>
                </div>
            </div>
	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
