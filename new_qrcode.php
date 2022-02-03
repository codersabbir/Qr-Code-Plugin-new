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
$post_url   = urlencode( get_the_permalink($post_id));
$post_type  = get_post_type($post_id);

    $exclude_post = apply_filters( 'excluded_post_types', array() );
    if ( in_array( $post_type, $exclude_post ) ) {
    return $content;
    }
    $height    = get_option( 'qr_height' );
    $width     = get_option( 'qr_width' );
    $height    = $height ? $height : 180;
    $width     = $width ? $width : 180;


    $dimension = apply_filters( 'qr_qrcode_dimension', "{$width}x{$height}" );
    $image_attribute = apply_filters( 'qr_image_attributes', null );
    $image_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s', $dimension, $post_url);
    $content   .= sprintf("<div class='qrcode'><img %s  src='%s' alt='%s' /></div>", $image_attribute, $image_src, $post_title ;
    return $content;
}


        add_filter('the_content', 'display_qr_code');

function qr_settings_init(){

    add_settings_section('qr_section',__('Posts to QR Code','posts-to-qrcode'),'qr_section_callback','general');
    add_settings_field( 'qr_height', __('QR Code Height', 'posts-to-qrcode' ), 'qr_display_field', 'general','qr_section',array('qr_height'));
    add_settings_field('qr_width', __('QR Code Width', 'posts-to-qrcode'), 'qr_display_field', 'general','qr_section',array('qr_width') );
    add_settings_field('qr_extra', __('Extra Field', 'posts-to-qrcode'), 'qr_display_field', 'general','qr_section',array('qr_extra'));


    register_setting('general', 'qr_height', array( 'sanitize_callback' => 'esc_attr'));
    register_setting('general', 'qr_width', array( 'sanitize_callback' => 'esc_attr'));
    register_setting('general', 'qr_extra', array( 'sanitize_callback' => 'esc_attr'));
}

function qr_section_callback(){
    echo "<p>".__('Settings for Qr code Plugin','posts-to-qrcode')."</p>";
}




function qr_display_field($args){

    $option = get_option($args[0]);
    printf("<input type='text' id='%s' name='%s' value='%s'/>", $args[0], $args[0], $option);

}



function qr_display_height() {

    $height = get_option('qr_height');
    printf("<input type='text' id='%s' name='%s' value='%s'/>", 'qr_height', 'qr_height', $height);
}



function qr_display_width() {
    $width = get_option('qr_width');
    printf("<input type='text' id='%s' name='%s' value='%s'/>", 'qr_width', 'qr_width', $width);
}



add_action("admin_init", 'qr_settings_init');

