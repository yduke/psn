<?php
/**
 * The template for displaying content in the single.php template.
 *
 */

 $post_type=get_post_type();
 if(  $post_type == 'psn_trophy' ){
	get_template_part( 'template-parts/content', 'single-trophy' );
 }elseif(  $post_type == 'psn_game' ){
	get_template_part( 'template-parts/content', 'single-game' );
 }
?>

