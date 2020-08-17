  <?php
  
/***************************************************************************************
 * WIGET DE RECOMMANDATION
 ***************************************************************************************/

add_action("widgets_init", "bs_proprietes_widgets_init");

function bs_proprietes_widgets_init() {

	register_sidebar(
		array(
			'name'          => "Barre latéral droite de Propriétés",
			'id'            => 'sidebar-2',
			'description'   => 'Ajouter des Widget ici pour apparetre au barre latéral droite de proprietes .', 
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
        )
	); 
}

  add_action('widgets_init', function(){
    
    register_widget('BsRecommandation');    // Nom de la classe du Widget
});

// Création de classe "BsRecommandation" qui hérite de la class "WP Widget"

class BsRecommandation extends WP_Widget{
    /**
     * Constructeur de la classe, appel le constructeur du parent pour créer le widget
     */
    public function __construct(){
        parent::__construct(
            'bs_recommandation',  // Id unique
            'Recommandation de Propriétés', // Beau nom
            array('description'=>'ce widget afficher les recommandation de proprietes') // Autres paramètres...
        );
    }
    /**
     * Produit le code HTML du widget
     * @param array $args Paramètres passés par WP
     * @param array $instance
     */
    public function widget($args, $instance){
       
        
        echo $args['before_widget'];
        if(!empty($instance['title'])){
            echo $args['before_title'];
            echo $instance['title'];
            echo $args['after_title'];
        }

	   $sVille = get_field('bs_ville');
	   $sPrix = get_field('bs_ville');
	   $sPourcentage = ((get_field('bs_prix') * $instance['pourcentage']))/100;
	   $plusgrandque = get_field('bs_prix') -$sPourcentage;
	   $pluspetitdque = get_field('bs_prix') + $sPourcentage;
		$args1 = [
			'post_type'      => 'bs_propriete',
			'posts_per_page' => 3,
			'post__not_in' => array (get_the_ID()),
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'bs_ville',
					'value'		=> $sVille,
					'compare'	=> '='
				),				
				array(
					'key'		=> 'bs_prix',
					'value'   => array($plusgrandque, $pluspetitdque ),
					'type'    => 'numeric',
					'compare' => 'BETWEEN',
				)
			)
				
		];
		$loop = new WP_Query($args1);
		?><div class="row mt-3 justify-content-center">
				<?php
		while ( $loop->have_posts() ) :
			$loop->the_post();
			
			get_template_part( 'template-parts/content', 'page-bs_propriete' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
    }

    /**
     * Produit le formulaire de configuration
     * @param array $instance Les options du widget
     */
    public function form($instance){
       
        if(isset($instance['title'])){
            $title = $instance['title'];
        }else{
            $title = '';
		}
		
		if(isset($instance['pourcentage'])){
            $pourcentage = $instance['pourcentage'];
        }else{
            $pourcentage = 50;
        }
       
    
       
        ?>
        <label for='title'>Title:</label>
        <input value='<?php echo $title; ?>' type='text' name='<?php echo $this->get_field_name('title'); ?>' class='widefat' id='<?php echo $this->get_field_id('title'); ?>'>
		<br><br>
		<label for='pourcentage'>Pourcentage (%):</label>
        <input value='<?php echo $pourcentage; ?>' type='text' name='<?php echo $this->get_field_name('pourcentage'); ?>' class='widefat' id='<?php echo $this->get_field_id('pourcentage'); ?>'>
        <br><br>
    
        <?php 
    }

    /**
     * Gère la mise à jour des options du widget
     * @param array $new_instance Nouvelles valeurs
     * @param array $old_instance Anciennes valeurs
     */
    public function update($new_instance, $old_instance){
    
        //Vérification des champs si les champs des heures sont vides en remplace la valeur par "00: 00"

        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ?  $new_instance['title'] :  "";

		$instance['title'] = strip_tags($instance['title']);

		$instance['pourcentage'] = (!empty($new_instance['pourcentage'])) ?  $new_instance['pourcentage'] :  "50";

        $instance['pourcentage'] = strip_tags($instance['pourcentage']);


        return $instance;
    }
}

