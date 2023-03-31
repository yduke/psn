<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );

$post   = get_post( 2964 );
var_dump($post);