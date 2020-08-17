<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package immobilier
 */

?>
<?php 

$image = get_field('bs_image');

if( !empty($image) ): 

	// vars
	$url = $image['url'];
	$title = $image['title'];
	$alt = $image['alt'];
	$caption = $image['caption'];

	// thumbnail
	$size = 'thumbnail';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];


 endif; ?>

  <div class="card card-custom mx-2 mb-3">
  	<div class="contenaire-image-carte">
		<img class="card-img-top"src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
		<div class="prix-carte"><?=number_format_i18n(get_field('bs_prix'))?> $</div>
	</div>
    <div class="card-body">
      <?php the_title( '<h5 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
	  <p class="card-text"></p>
	  <i class="fas fa-map-marker-alt"> </i><?=" " .get_field('bs_ville')?><br>
	  <div class="d-flex justify-content-between pt-3">
		  <div> <small class="text-muted"><i class="fas fa-bed"></i> <?=" " .get_field('bs_nombre_de_chambre')?> chambre<?= get_field('bs_nombre_de_chambre') > 1?"s":"" ?></small></div>
		  <div> <small class="text-muted"><i class="fab fa-buffer"></i> <?=" " .get_field('bs_nombre_etage')?> étage<?= get_field('bs_nombre_etage') > 1?"s":"" ?></small></div>
		  <div><small class="text-muted"><i class="fas fa-border-style"></i><?=" " .get_field('bs_dimension_du_batiment')?> m<sup>2</sup></small></div>
	  </div>

    </div>
  </div>




