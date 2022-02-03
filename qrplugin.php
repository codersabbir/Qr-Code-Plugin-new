<?php
/*



Plugin Name: QR Code
Plugin URI:
Version: 1.1
Author: Sabbir
Author URI: https://wppool.dev
Description: Display Qr Code
License: GPLv2 or later
Text Domain: qrcode
Domain Path: /languages/
*/

/*
function wordcountActivation(){}
register_activation_hook(__FILE__,"wordcountActivation");

function wordcountDeactivation(){}
register_deactivation_hook(__FILE__,"wordcountDeactivation");
*/



function wordcount_load_textdomain(){
    load_plugin_textdomain('qrcode', false, dirname(__FILE__) . "/languages");
    }



function display_qr_code($content){

    $post_id = get_the_ID();
    $post_title = get_the_title($post_id);
    $post_url  = urlencode( get_the_permalink($post_id));
    $post_type = get_post_type($post_id);

    $exclude_post = apply_filters('excluded_post_types', array());
    if (in_array($post_type, $exclude_post)){
    return $content;
    }


    $dimension = apply_filters('qr_qrcode_dimension', "{$width}x{$height}");
    $image_attribute = apply_filters('qr_image_attributes', null);
    $image_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s', $dimension, $post_url);
    $content .= sprintf("<div class='qrcode'><img %s  src='%s' alt='%s' /></div>", $image_attribute, $image_src, $post_title ;
    return $content;
}


add_filter('the_content', 'display_qr_code');