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

$r = update_steam_game_with_local_json();

echo '<pre>';
 var_dump($r);
echo '</pre>';

