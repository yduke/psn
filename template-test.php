<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

    // $ownedGames = SaveOwnedGames();
// var_dump($ownedGames);
                    $query_meta = array(
                        'post_type' => 'steam_game',
                        'meta_key' => 'appid',
                        'meta_value' => '292030'
                    );
                    $time_posts = new WP_Query( $query_meta );

var_dump($time_posts->post->ID);
