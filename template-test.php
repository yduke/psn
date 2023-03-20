<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

$ar = get_date_from_gmt( date("Y-m-d H:i:s", 1041379200), 'Y-m-d H:i:s' );
var_dump($ar );