<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );
    $args = array(
        'post_type' => 'steam_game',
        'meta_query' => array(
            array(
                'key' => 'img_library',
                'value' => '',
                'compare' => 'NOT EXISTS'
            )
        ),
        'posts_per_page' => -1,
        'orderby'=>'rand'
    );
    $posts = get_posts($args);
	$post_id = reset($posts)->ID;
	$appid = get_post_meta($post_id, 'appid',true);
	var_dump($appid);