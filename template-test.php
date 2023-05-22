<?php
/*
Template Name: TEST
*/
// header( 'Content-Type: application/json' );

    $args = array(
        'post_type' => array('steam_game',),
        'posts_per_page' => -1,
        'orderby'=>'date',
		'order'       => 'DESC',
    );
    $posts = get_posts($args);
	
	if($posts){
		foreach($posts as $post){
			// echo $post -> ID;
			// echo $post -> post_title;
			// echo '<br/>';
			// update_post_meta($post -> ID,'owned','1');
			// delete_post_meta($post -> ID,'ownwd');
			SaveSteamdeckStatus($post -> ID);
		}
	}