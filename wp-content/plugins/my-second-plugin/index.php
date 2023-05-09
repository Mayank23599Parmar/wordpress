<?php
/*
 * Plugin Name:       My second plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mayank Parmar
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class MySecondPlugin
{
    public function __construct()
    {
        add_action("admin_menu", array($this, "adminMenu"));
        add_filter("the_content", array($this, "filter_content"));
    }
    public function filter_content($content)
    {
        $findWords = explode(",", get_option("plugin_word_to_filter"));
        $badWordTrip = array_map("trim", $findWords);
        // print_r($findWords);
        // print_r($badWordTrip);
        return str_ireplace($badWordTrip,get_option("replace_word_with"),$content);
    }
    public function adminMenu()
    {
        $mainPageHook = add_menu_page("Word Filter", "Word Filter", "manage_options", "my-word-filter", array($this, "pluginMainPage"), plugin_dir_url(__FILE__) . "/plus-circle.svg", 10);
        add_submenu_page("my-word-filter", "Word Filter", "Word Filter List", "manage_options", "my-word-filter", array($this, "pluginMainPage"));
        add_submenu_page("my-word-filter", "Options", "Options", "manage_options", "word-filter-options", array($this, "pluginOptionPage"));
        add_action("load-{$mainPageHook}", array($this, "manageAssests"));
    }
    public function manageAssests()
    {
        wp_enqueue_style("plugin-css", plugin_dir_url(__FILE__) . "style.css");
        # code...
    }



    function handleForm()
    {
        if (wp_verify_nonce($_POST["ourNouse"], "saveNouse") && current_user_can("manage_options")) {
            update_option("plugin_word_to_filter", sanitize_textarea_field(trim($_POST['plugin_word_to_filter'])));

?>
            <div class="updated">
                You are updated successfully
            </div>
        <?php
        } else {
        ?>
            <div class="error">
                You dont have permision to submit this form
            </div>
        <?php
        }
    }


    public function pluginMainPage()
    {
        ?>
        <div class="word-filter">
            <h1>Word Filter</h1>
            <?php if ($_POST['justSubmited'] == "true") $this->handleForm() ?>
            <form method="POST">
                <input type="hidden" value="true" name="justSubmited" />
                <?php wp_nonce_field("saveNouse", "ourNouse") ?>
                <label for="plugin_word_to_filter">Enter Comma seperated list of words</label>
                <div>
                    <textarea name="plugin_word_to_filter" placeholder="Enetr comma seperated word">
                        <?php echo esc_textarea(get_option("plugin_word_to_filter")) ?>
                    </textarea>
                </div>
                <button class="button-primary">Submit</button>
            </form>
        </div>
        <?php
        # code...
    }
    public function pluginOptionPageSubmit()
    {
        if (wp_verify_nonce($_POST["pluginOptionPageNonce"], "saveOptionpageNonce") && current_user_can("manage_options")) {
            update_option("replace_word_with", sanitize_text_field($_POST["replace_word_with"]))
        ?>
            <div class="updated">
                You are updated successfully
            </div>
        <?php
        } else {
        ?>
            <div class="error">
                You dont have permision to submit this form
            </div>
        <?php
        }
    }

    public function pluginOptionPage()
    {
        ?>
        <div class="word-options">
            <h1>Word options</h1>
            <?php if ($_POST['pluginOptionPageSubmited'] == "true") $this->pluginOptionPageSubmit() ?>
            <form method="post">
                <input type="hidden" value="true" name="pluginOptionPageSubmited" />
                <?php wp_nonce_field("saveOptionpageNonce", "pluginOptionPageNonce") ?>
                <div>
                    <label for="replace_word_with">Bad Words Replace with</label>
                    <input value="<?php echo get_option("replace_word_with") ?>" type="text" name="replace_word_with" placeholder="Enter word with you can replace with bad words">
                </div>
                <button class="button-primary">Submit</button>
            </form>
        </div>
<?php
        # code...
    }
}
$OBJ = new MySecondPlugin();
?>