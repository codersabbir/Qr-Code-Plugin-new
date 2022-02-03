<?php
function twentytwentyone_wordcount_heading($heading){
	$heading = "Total Words";
	return $heading;
}
add_filter('wordcount_heading', 'twentytwentyone_wordcount_heading');

function twentytwentyone_wordcount_tag($t){
	$t = "p";
	return $t;
}
add_filter('wordcount_tag', 'twentytwentyone_wordcount_tag');

function twentytwentyone_readingtime_heading($heading){
	$heading = "Total minutes of reading";
	return $heading;
}

add_filter('wordcount_readingtime_heading', 'twentytwentyone_readingtime_heading');

function twentytwentyone_wordcount_word($countwords){
	$countwords = 5000;
	return $countwords;
}
add_filter('wordcount_word', 'twentytwentyone_wordcount_word');


function twentytwentyone_change_title($t){
	$t = "I've Changed the Post title";
}
add_filter('change_the_title', 'twentytwentyone_change_title');