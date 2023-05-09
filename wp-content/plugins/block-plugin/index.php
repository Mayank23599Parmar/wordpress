<?php
/*
 * Plugin Name:       My First Block Plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mayank Parmar
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class MyFirstBlockPlugin{
 function __construct()
{
     add_action("init",array($this,"myBlockAssest"));

}
public function myBlockAssest()
{
    wp_register_style("myGuten-style",plugin_dir_url(__FILE__)."build/index.css");
    wp_register_script("myGuten-script",plugin_dir_url(__FILE__)."build/index.js",array("wp-blocks","wp-element","wp-editor"));
    register_block_type("our-plugin/our-attention",array(
        'editor_script'=>"myGuten-script",
        'editor_style'=>"myGuten-style",
        "render_callback"=>array($this,"saveBtn")
    ));
}
public function saveBtn($atribute)
{
    wp_enqueue_script("frontend-script",plugin_dir_url(__FILE__)."build/frontend.js",array("wp-element"));
    wp_enqueue_style("frontend-style",plugin_dir_url(__FILE__)."build/frontend.css");
    ob_start();
    ?>
    <div class="block-output">
        <pre style="display: none;"><?php echo wp_json_encode($atribute) ?></pre>
    </div>
    <?php 
    return ob_get_clean();
}
}
new MyFirstBlockPlugin(); 
?>