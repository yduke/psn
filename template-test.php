<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );


// $appid = 601430;
// $temp = GetGameTrophiesStatus($appid)->achievements;
// $c = 0;
// foreach($temp as $achi){
	// if($achi->achieved == 1){
		// $c++;
	// }
// }
// var_dump($c);

// $value = get_date_from_gmt( date("Y-m-d H:i:s", '0'), 'Y-m-d H:i:s' );

// var_dump($value);


		// $appid = '601430';
		// $arr = array(
			// 'post_type' => 'stm_trophy',
			// 'meta_query' => array(
				// 'relation' => 'AND',
				// array(
					// 'key' => 'appid',
					// 'value' => $appid,
					// 'compare' => '=',
				// ),
				// array(
					// 'key' => 'achieved',
					// 'value' => '0',
					// 'compare' => '=',
				// ),
			// ),
			// 'orderby' => 'post_date',
			// 'posts_per_page' => -1,
		// );
        // $posts = new WP_Query( $arr );

   // var_dump( $posts->found_posts);
// GetSpecialSales();
// var_dump( get_date_from_gmt( date("Y-m-d H:i:s", 1041379200), 'Y-m-d H:i:s' ));
// $appid='258160';
$url = 'https://psn.dukeyin.com/wp-json/psn/v1/player';
$array = get_remote_json($url);
// $filename = 'player';
// $r = GetGameTrophies($appid)->availableGameStats->achievements;
// var_dump($r);

    // $r = GetGameTrophiesStatus($appid)->achievements ?? false;
    $r = save_array_as_json($array, $folder='dk-psn/temp/', 'players', false, $expire = 3);
var_dump( $r);