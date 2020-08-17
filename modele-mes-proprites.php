<?php
/* Template Name: Mes propriete */
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
?>
	
	<div class="bs_banner  d-flex  flex-column justify-content-center align-items-center " style='height:30vh; width: 100%;'>
	<div class="d-flex align-items-center text-white">
		<h1>Trouvez votre maison de rêve</h1>
	</div>
	
	

	<form action=""  method="get" class="d-flex align-items-center col-5">
		<div class="col m-0 p-0">
			<select name="trie" class="custom-select mr-sm-2">
				<option value="bs_ville" <?php echo isset($_GET["trie"]) && $_GET["trie"] == "bs_ville" ? "selected":"" ?>>Ville </option>
				<option value="bs_prix" <?php echo isset($_GET["trie"]) && $_GET["trie"] == "bs_prix" ? "selected":"" ?>>Prix</option>
			</select>
		</div>
		<div class="col m-0 p-0">
			<select name="ordre" class="custom-select mr-sm-2">
				<option value="ASC" <?php echo isset($_GET["ordre"]) && $_GET["ordre"] == "ASC" ? "selected":"" ?>>Ascendant</option>
				<option value="DESC"<?php echo isset($_GET["ordre"]) && $_GET["ordre"] == "DESC" ? "selected":"" ?>>Descendant</option>
			</select>
		</div>
		<div class="col m-0 p-0">
			<input type='hidden' name='page_id' value='<?= get_the_ID();?>'>
			<button type="submit" value="Submit" class="btn btn-primary btn-block">Filtrer</button>
		</div>
		</form>
		
	</div>
	<div id="primary" class="content-area container">
		<main id="main" class="site-main">
		
		<?php
		if (isset($_GET["trie"])) {
			$trie = $_GET["trie"];
		}else{
			$trie = "bs_ville";
		}
		if (isset($_GET["ordre"])) {
			$ordre = $_GET["ordre"];
		}else{
			$ordre = "ASC";
		}

        $args = [
			'post_type'      => 'bs_propriete',
			'posts_per_page' => -1,
			'meta_key'		=> $trie,
			'orderby'    => 'meta_value',
			'order'   => $ordre,
		];

		$loop = new WP_Query($args);
		?><div class="row mt-5 justify-content-center">
				<?php
		while ( $loop->have_posts() ) :
			$loop->the_post();
			
			get_template_part( 'template-parts/content', 'page-bs_propriete' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
