<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

$args = array(
    'meta_query' => array(
        array(
            'key' => 'release_date',
            'value' => '123'
        )
    ),
    'post_type' => 'steam_game',
    'posts_per_page' => -1,
	'orderby'=>'rand'
);
$posts = get_posts($args);
if($posts){
	var_dump(reset($posts)->ID);
}

