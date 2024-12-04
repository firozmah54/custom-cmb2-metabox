<?php 
/**
 * Plugin Name: Academy Custom Metaboxes Plugin
 * Plugin URI: https://wedevs.academy
 * Description: This plugin adds a custom metabox to WordPress.
 * Version: 0.1.0
 * Author: Firoz mahmud
 * Author URI: https://firoz.co
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: my-taxonomy-plugin
 */

 if(!defined('ABSPATH')) {
    exit;
 }

 class wedevs_custom_post_Metabox {
    private static $instance ;

    public static function get_instance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

private function __construct() {
    $this->require_classes();
}

public function require_classes() {
    require_once __DIR__ . '/includes/custom-post.php';
    require_once __DIR__ . '/lib/cmb2/init.php';

    new wedevs_custom_post_Metabox_pl();
}

 }
 wedevs_custom_post_Metabox::get_instance();