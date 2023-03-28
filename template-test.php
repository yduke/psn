<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

$args = array(
	'post_type' => 'steam_game',
    'meta_query' => array(
        array(
            'key' => 'release_date',
			'compare' => 'NOT EXISTS'
        )
    ),
    'posts_per_page' => -1,
	'orderby'=>'rand'
);
$posts = get_posts($args);
if($posts){
	var_dump(reset($posts)->post_title);
}

