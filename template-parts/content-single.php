<?php
/**
 * The template for displaying content in the single.php template.
 *
 */

 $post_type=get_post_type();
 if(  $post_type == 'psn_trophy' ){
	get_template_part( 'template-parts/content', 'single-psn_trophy' );
 }elseif(  $post_type == 'psn_game' ){
	get_template_part( 'template-parts/content', 'single-psn_game' );
 }elseif(  $post_type == 'steam_game' ){
	get_template_part( 'template-parts/content', 'single-steam_game' );
 }elseif(  $post_type == 'stm_trophy' ){
	get_template_part( 'template-parts/content', 'single-steam_trophy' );
 }
?>

