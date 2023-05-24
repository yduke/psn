<?php
/*
Template Name: TEST
*/
// header( 'Content-Type: application/json' );
// $appid  = 19000;
$r = GetRecentlyPlayedGames();
echo '<pre>';
var_dump($r);
echo '</pre>';