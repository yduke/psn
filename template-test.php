<?php
/*
Template Name: TEST
*/
header( 'Content-Type: application/json' );


// echo download_image('https://image.api.playstation.com/trophy/np/NPWR10861_00_00A90BAC617B51748B93CD9C38F187F837F1D770FE/E63CB9DDE35BCF01E2C571ADF5E50D9D5D85E3DA.PNG', 600, true, '雾中怪屋');
global $wpdb;
var_dump($wpdb->get_results($wpdb->prepare("SELECT ID as post_id FROM $wpdb->posts WHERE post_type='attachment' AND BINARY guid='%s'", 'http://localhost/dk-psn/wp-content/uploads/dk-psn/trophy/np/NPWR10861_00_00A90BAC617B51748B93CD9C38F187F837F1D770FE/E63CB9DDE35BCF01E2C571ADF5E50D9D5D85E3DA.webp' )));