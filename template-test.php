<?php
/*
Template Name: TEST
*/
// header( 'Content-Type: application/json' );
// $appid  = 1515950;

// $r = GetSteamdeckVerified($appid);
// echo '<pre>';
// set_time_limit(0);
// $json= download_as_json($url, $folder='dk-psn/temp/', 'temp', false, 3);
// $r = GetGlobalAchievementPercentagesForApp($appid);

// foreach($acps as $q => $acp){
	// if($acp->name == 'weapon_smith'){
			// echo $q;
			// echo '<br>';
			// echo $acp->percent;
			// break;
	// };

// }
// echo 'found';
$expire = 1;
$wp_upload_dir = wp_upload_dir();
$local_path = $wp_upload_dir['basedir'].'/dk-steam/api_cache/featuredcategories.json';
$filetime = filemtime($local_path );
$time = time();
// $r = update_steam_game_with_local_json();

echo '<pre>';
 var_dump($time);
 var_dump($filetime);
 var_dump($time - $filetime);
 var_dump(floatval($expire)*86400);
 var_dump(($time - $filetime < floatval($expire)*86400));
echo '</pre>';

