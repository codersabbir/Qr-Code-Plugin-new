<?php
/*

Plugin Name: Word Count
Plugin URI:
Version: 1.1
Author: Sabbir
Author URI: https://wppool.dev
Description: Count word of any content
License: GPLv2 or later
Text Domain: word-count
Domain Path: /languages/

*/

/*
function wordcountActivation(){}
register_activation_hook(__FILE__,"wordcountActivation");

function wordcountDeactivation(){}
register_deactivation_hook(__FILE__,"wordcountDeactivation");
*/
function wordCountLoadTextdomain(){
    load_plugin_textdomain('word-count', false,dirname(__FILE__)."/languages");
}
add_action("plugins_loaded",'wordCountLoadTextdomain');


// function wordcount_count_words($content){

    // do_action('wordcount_in_action_hook', $label);
//     $content_word = strip_tags($content);
//     $wordn = str_word_count($content_word);
//     $label = __('Total number of words of this content', 'word-count');
//     $content .= sprintf('<h2>%s: %s</h2>',$label,$wordn );
//     return $content;
// }



// Filter hook in Plugin

function wordcount_count_words($content){
    $content_word = strip_tags($content);
    $wordn = str_word_count($content_word);
    $label = __('Total number of words of this above content', 'word-count');
    $label = apply_filters("wordcount_heading", $label);
    $tag = apply_filters('wordcount_tag', 'h2');
    $content .= sprintf('<%s>%s: %s</%s>',$tag,$label,$wordn,$tag);
    return $content;
}
add_filter('the_content', 'wordcount_count_words');


function word_reading_time($content){
    $content_word = strip_tags($content);
    // $wordn = str_word_count($content_word);
    $wordn = 1000;
    $wordn = apply_filters('wordcount_word', $wordn);
    // $reading_word = ceil($wordn/200);
    $reading_word = floor($wordn/200);
    // $reading_second = ceil($wordn % 200 / (200/60));
    $reading_second = floor($wordn % 200 / (200/60));
    $is_visible = apply_filters('wordcount_displey_reading_time', 1);
    if($is_visible){
        $label = __('Total reading time of this above content', 'word-count');
        $label = apply_filters("wordcount_readingtime_heading", $label);
        $tag = apply_filters('wordcount_readingtime_tag', 'h5');
        $content .= sprintf('<%s>%s: %s minute %s second</%s>',$tag,$label,$reading_word,$reading_second,$tag);
    }
    return $content;
}
add_filter('the_content', 'word_reading_time');

function title_change($title){
    // echo "<h1>".$title."</h1>";
    $title = "Hello Boss";
    // $title_word = strip_tags($title);
    // $tag = apply_filters('wordcount_readingtime_tag', 'h5');
    $label = __('Total reading time of this above content', 'word-count');
    $label = apply_filters('change_the_title', $label);
    // $title .= sprintf('<%s> %s </%s>',$tag,$title_word,$tag);
    return $title;
    // var_dump($title);
    

}
add_filter('the_title', 'title_change');

