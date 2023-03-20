<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

$ar = SaveOwnedGames();
var_dump($ar );