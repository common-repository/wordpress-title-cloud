<?php
/**
 * @package Wordpress Title Cloud
 * @version 1.0.0
 */
/*
Plugin Name: Wordpress Title Cloud
Plugin URI: http://wordpress.org/extend/plugins/wordpress-title-cloud/
Description: An Idea of Displaying texts as tag cloud using your page titles.
Author: Burt Adem
Version: 1.0.0
Author URI: http://burtadem.com/
*/
include('wordpress-title-cloud.php');  
$oTitleCloud = new wordpress_title_cloud();


function wpttlcloud_headHook(){
 if(is_page() || is_single()){global $post,$oTitleCloud;$oTitleCloud->cloud_visit($post->ID); }
}
add_action('wp_head', 'wpttlcloud_headHook');
function cloud_rs(){
    global $oTitleCloud;
    $oTitleCloud->show_cloud();

}


function titlecloud_admin() {  
 include('wp-titlecloudadmin.php');  
}  

function tc_admin_actions() {  
    add_options_page("Wordpress Title Cloud", "Title Cloud", 1, "wp-titlecloudadmin", "titlecloud_admin");  
}  
  
add_action('admin_menu', 'tc_admin_actions');  

$area=get_option('wp-titlecloud_area');
if($area=="wp_footer" || $area=="dynamic_sidebar"){
add_action($area, 'cloud_rs');
}
function cloud_css(){
    global $oTitleCloud;
     $oTitleCloud->titlecloudy_css();
}

add_action('wp_head','cloud_css');


?>
