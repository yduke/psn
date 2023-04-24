<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );
    // $wp_upload_dir = wp_upload_dir();
    // $local_url= $path = $wp_upload_dir['basedir'].'/'.'dk-steam/appdetails/'.'123'.'.json';
	// $ldetail =  get_remote_json($local_url);
$d = GetGameDetail('1942280');
var_dump($d);