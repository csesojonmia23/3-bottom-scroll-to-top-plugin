<?php
/*
Plugin Name: Bottom Scroll to Top
Plugin URI: https://wordpress.org/plugins/bottom-scroll-to-top/
Description: Instantly navigate to the top of any page with a single click.
Version: 1.0.0
Requires at least: 5.2
Requires PHP: 7.2
Author: Engr Sojon Mia
Author URI: https://www.sojonmiawebdeveloper.com
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Update URI: https://github.com/csesojonmia23
Text Domain: bstt
*/

// Enqueue the JavaScript and CSS files
function bstt_enqueue_scripts_and_styles() {
    wp_enqueue_script('bstt-arrow-script', plugins_url('/js/bottom-scroll-to-top.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_style('bstt-arrow-style', plugins_url('/css/bottom-scroll-to-top.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'bstt_enqueue_scripts_and_styles');
// Theme Menu Page for Plugin
function bstt_custom_theme_option(){
     add_menu_page('Bottom Scroll to Top', 'Scroll to Top', 'manage_options', 'scroll_top_top', 'bstt_plugin_create_page', 'dashicons-arrow-up-alt2', 101);
// Sub Menu page
     add_submenu_page( 'scroll_top_top', 'Scroll to Top', 'General', 'manage_options', 'scroll_top_top', 'bstt_plugin_create_page', );
}
add_action( 'admin_menu', 'bstt_custom_theme_option');
// Callback Function
function bstt_plugin_create_page(){
     ?>
          <div class="bstt_plugin">
               <?php echo "<h1>Bottom Scroll to Top</h1>"; echo "<p>Customize Your <strong>Scroll Button</strong> here.</p>"; ?>

               <form action="options.php" method="post">
                    <?php wp_nonce_field('update-options') ?>
                    <!-- Background Color -->
                    <label for="bstt_background" name="bstt_background">Background Color:</label>
                    <input type="color" name="bstt_background" value="<?php echo get_option('bstt_background'); ?>" placeholder="Enter Your Address"> <br><br>
                    <!-- Icon Color -->
                    <label for="bstt_icon_color" name="bstt_icon_color">Icon Color:</label>
                    <input type="color" name="bstt_icon_color" value="<?php echo get_option('bstt_icon_color'); ?>" placeholder="Enter Your Address"> <br><br>
                    <!-- Border Radius -->
                    <label for="bstt_border" name="bstt_border">Border Radius (px or %):</label>
                    <input type="text" name="bstt_border" value="<?php echo get_option('bstt_border'); ?>" placeholder="Default 50%"> 

                    <br><br><br>
                    <!-- Save Values -->
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="page_options" value="bstt_background, bstt_border, bstt_icon_color">
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Info', 'bstt') ?>">
               </form>
          </div>
     <?php
}

// Scroll Button CSS
     function bstt_btn_css(){
          ?>
               <style>
                    #back-to-top{
                         background-color:<?php print get_option("bstt_background"); ?>;
                         border-radius: <?php print get_option("bstt_border"); ?>;
                    }
                    #back-to-top i.arrow-up{
                         color:<?php print get_option("bstt_icon_color"); ?>;
                    }

               </style>
          <?php
     }
     add_action('wp_head', 'bstt_btn_css');
/*=====================================
* Plugin Redirect Feature
*/
register_activation_hook( __FILE__, 'bstt_plugin_activation' );
function bstt_plugin_activation(){
    add_option('bstt_plugin_do_activation_redirect', true);
  }

add_action( 'admin_init', 'bstt_plugin_redirect');
function bstt_plugin_redirect(){
    if(get_option('bstt_plugin_do_activation_redirect', false)){
      delete_option('bstt_plugin_do_activation_redirect');
      if(!isset($_GET['active-multi'])){
        wp_safe_redirect(admin_url('admin.php?page=scroll_top_top'));
        exit;
      }
    }
  }

?>