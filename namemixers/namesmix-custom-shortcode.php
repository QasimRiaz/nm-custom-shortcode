<?php 
/**
 * Plugin Name:       Names Mixers Custom Shortcode
 * Plugin URI:        https://github.com/QasimRiaz/nm-custom-shortcode
 * Description:       Create New Names Mixers
 * Version:           1.0.0
 * Author:            Qasim
 * License:           GNU General Public License v2
 * Text Domain:       WM
 * Network:           true
 * GitHub Plugin URI: https://github.com/QasimRiaz/nm-custom-shortcode
 * Requires WP:       5.0.3
 * Requires PHP:      7.4
 * Date 09/08/2022
 */



define( 'NMCUSTOMSHORTCODE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NMCUSTOMSHORTCODE_VERSION', '1.2.1' );


register_activation_hook( __FILE__, array( 'NMCustomshortcode', 'nm_custom_shortcode_plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'NMCustomshortcode', 'nm_custom_shortcode_plugin_deactivation' ) );



require_once( NMCUSTOMSHORTCODE__PLUGIN_DIR . 'class.namesmixcustomshortcode.php' );


add_action( 'init', array( 'NmCustomShortCode', 'init' ) );
add_action( 'manage_wm-custom-shortcode_posts_custom_column' , array( 'WmCustomShortCode', 'wm_custom_shortcode_column_value' ) , 10, 2 );

add_shortcode( 'namemixser-custom-shortcode', array( 'NmCustomShortCode', 'nm_custom_shortcode_loadfrm' ) );


add_action( "wp_ajax_loadfrm", array( 'NmCustomShortCode', 'nm_custom_shortcode_resultgenrate' ) );
add_action( "wp_ajax_nopriv_loadfrm", array( 'NmCustomShortCode', 'nm_custom_shortcode_resultgenrate' ) );

add_action( 'frm_form_classes', array( 'NmCustomShortCode', 'wmcustomcode_formidable_class' )  );