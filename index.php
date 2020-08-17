<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package immobilier
 */

get_header();
?>
	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

		<?php
		$args = [
			'post_type'      => 'bs_propriete',
			'posts_per_page' => get_theme_mod('bs_nombre_propriétés',10),
			'orderby' => 'publish_date',
    		'order' => 'DESC'
		];
		$loop = new WP_Query($args);
		?>
		<div class="row mt-5 justify-content-center">
		<?php
		if ( $loop->have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( $loop->have_posts() ) :
				$loop->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'page-bs_propriete' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
