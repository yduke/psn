<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );
$unlocktime     = get_date_from_gmt( date("Y-m-d H:i:s", 1561636321), 'Y-m-d H:i:s' );
var_dump($unlocktime);

