<?php
/**
 * immobilier Theme Customizer
 *
 * @package immobilier
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bs_immobilier_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'bs_immobilier_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'bs_immobilier_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'bs_immobilier_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bs_immobilier_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bs_immobilier_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bs_immobilier_customize_preview_js() {
	wp_enqueue_script( 'bs_immobilier-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bs_immobilier_customize_preview_js' );

/**
 * ajoute doption de theme 
 */
add_action('customize_register', 'bs_customizer' );

function bs_customizer($wp_customizer){
    
    $wp_customizer->add_panel("bs_menu_conf", 
    array(
        'title'=>'Propriétés',
        'description' => 'Configuration des propriétés',
    ));
    $wp_customizer->add_section('bs_menu_conf_section', 
    array(
        'panel'=>'bs_menu_conf',
        'title' => 'Propriétés',
        'description'=> 'nombre de propriétés affichées dans la page d\'accueil',
    ));

    $wp_customizer->add_setting('bs_nombre_propriétés', 
    array(
        'default'=>'10',
        'transport'=>'postMessage'
    ));

    $wp_customizer->add_control('bs_nombre_propriétés', 
    array(
        'label'=>'Nombre de propriétés',
        'section'=>'bs_menu_conf_section',
        'type'=>'text',
        
    ));
}