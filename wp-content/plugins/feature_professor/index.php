<?php
/*
 * Plugin Name:       Featured Proffesor
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mayank Parmar
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class FeaturedProffesor
{
    public function __construct()
    {
        add_action("init", array($this, "loadPluginAssests"));
        add_action("rest_api_init","feature_proffessor_api");
    }
    function feature_proffessor_api()
    {
        register_rest_route("feature/v1","proffessor",array(
            "methods"=>WP_REST_Server::READABLE, //GET METHOD
            "callback"=>"proffessor_api"
        ));
    }
    function proffessor_api($data)
    {
        $mainQuery=new WP_Query(array(
            "post_type"=>array("professor"),
            "page_id"=>$data["id"],
        ));
        $dataArray= array();
        while ( $mainQuery->have_posts()) {
            $mainQuery->the_post();
            $description=null;
            $getRelatedPrograms = get_field("related_pograms");
            $pograme=array();
            foreach ($getRelatedPrograms as $key => $programs) {
                array_push($pograme,array(
                    "title"=>get_the_title($programs),
                    "url"=>get_the_permalink($programs)
                ));
            }
                if(has_excerpt()){
                    $description=get_the_excerpt();
                }
                else{
                    $description=wp_trim_words(get_the_content(),15);
                }
                array_push($dataArray,array(
                    "title"=>get_the_title(),
                    "url"=>get_the_permalink(),
                    "postType"=>get_post_type(),
                    "authorName"=>get_the_author(),
                    "description"=> $description,
                    "relatedPrograms"=>$pograme
                ));
            
        }
        if(count($mainQuery->posts) > 0){
            return $dataArray;
        }else{
            $message = array(
                "message" => "No data found",
                "success" => false
    
            );
            return $message;
        }
       
    }
    public function loadPluginAssests()
    {
        wp_register_script("editor_feature_professor_script", plugin_dir_url(__FILE__) . "build/index.js", array("wp-element", "wp-blocks", "wp-editor"));
        wp_register_style("editor_feature_proffessor_style", plugin_dir_url(__FILE__) . "build/index.css");
        register_block_type("our-plugin/feature-proffessor", array(
            "editor_script" => "editor_feature_professor_script",
            "editor_style" => "editor_feature_proffessor_style",
            "render_callback" => array($this, "render_html")
        ));
    }
    public function render_html($attribute)
    {
        wp_enqueue_style("frontend_feature_professor_style", plugin_dir_url(__FILE__) . "build/frontend.css");
        wp_enqueue_script("frontend_feature_proffessor_style", plugin_dir_url(__FILE__) . "build/frontend.js", array("wp-element"));
        ob_start();
?>
        <div class="frontend_feature_professor">
            <pre style="display: none;"><?php echo wp_json_encode($attribute) ?></pre>
            <h1>i Am plugin frontend</h1>
        </div>
<?php
        return ob_get_clean();
    }
}
new FeaturedProffesor();
?>