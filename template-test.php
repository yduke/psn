<?php
/*
Template Name: TEST
*/
// header( 'Content-Type: application/json' );

    $args = array(
        'post_type' => array('steam_game', 'psn_game'),
        'posts_per_page' => -1,
        'orderby'=>'date'
    );
    $posts = get_posts($args);
	
	if($posts){
		foreach($posts as $post){
			// echo $post -> ID;
			// echo $post -> post_title;
			// echo '<br/>';
			// update_post_meta($post -> ID,'owned','1');
			delete_post_meta($post -> ID,'hide-game-post');
			delete_post_meta($post -> ID,'game_tittle_aka');
		}
	}