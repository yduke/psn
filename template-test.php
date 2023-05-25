<?php
/*
Template Name: TEST
*/
// header( 'Content-Type: application/json' );
$appid  = 1515950;

// $r = GetSteamdeckVerified($appid);
// echo '<pre>';
set_time_limit(0);
// $json= download_as_json($url, $folder='dk-psn/temp/', 'temp', false, 3);
$r = save_steam_achievements($appid);

echo '<pre>';
 var_dump($r);
echo '</pre>';