<?php
/*
Plugin Name: Booking
Plugin URI: https://profiles.wordpress.org/akabarikalpesh/
Description: Vehicles Booking .
Author: Kalpesh Akabari
Author URI: ttps://profiles.wordpress.org/akabarikalpesh/
Text Domain: booking 
Domain Path: /languages/
Version: 1.0.0
*/

    
if ( ! defined( 'ABSPATH' ) ) die( '<h3>Direct access to this file do not allow!</h3>' );       // Exit if accessed directly


////////////////////////////////////////////////////////////////////////////////
// PRIMARY URL CONSTANTS                        
////////////////////////////////////////////////////////////////////////////////

// ..\home\siteurl\www\wp-content\plugins\plugin-name\booking.php
if ( ! defined( 'BK_FILE' ) )             define( 'BK_FILE', __FILE__ ); 

//booking.php
if ( ! defined('BK_PLUGIN_FILENAME' ) )   define('BK_PLUGIN_FILENAME', basename( __FILE__ ) );                     

// plugin-name    
if ( ! defined('BK_PLUGIN_DIRNAME' ) )    define('BK_PLUGIN_DIRNAME',  plugin_basename( dirname( __FILE__ ) )  );  

// ..\home\siteurl\www\wp-content\plugins\plugin-name
if ( ! defined('BK_PLUGIN_DIR' ) )        define('BK_PLUGIN_DIR', untrailingslashit( plugin_dir_path( BK_FILE ) )  );

// http: //website.com/wp-content/plugins/plugin-name
if ( ! defined('BK_PLUGIN_URL' ) )        define('BK_PLUGIN_URL', untrailingslashit( plugins_url( '', BK_FILE ) )  );     


require_once BK_PLUGIN_DIR . '/function.php';