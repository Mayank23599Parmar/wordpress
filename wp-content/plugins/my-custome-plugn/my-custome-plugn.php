<?php
/*
 * Plugin Name:       My First plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mayank Parmar
 */
class showCustomPluginInDashboard
{
    function __construct()
    {
        add_action("admin_menu", array($this, "adminPageOption"));
        add_action("admin_init", array($this, "setting"));
        add_filter("the_content",array($this,"showContent"));
    }
    public function showContent($content)
    {
        if((is_main_query() AND is_single()) && (get_option("wcp_word_count") || get_option("wcp_charcter_count") || get_option("wcp_readTime"))){
           return $this->createHTML($content);
        }
        return $content;
    }
    public function createHTML($content)
    {
      $html="<h1>".  get_option("wcp_heading_title") ."</h3><p>";
      if(get_option("wcp_word_count") == "1"){
        $html=$html."Post has ".str_word_count($content) ." words <br/>";
      }
      if(get_option("wcp_charcter_count") == "1"){
        $html=$html."Post has ".strlen($content) . "characters <br/>";
      }
      if(get_option("wcp_readTime") == "1"){
        $html=$html."Post has ". round(str_word_count($content) / 253) ." min to read";
      }
      if(get_option("wcp_location") == "1"){
        return   $content . $html ;
      }
      return $html. $content;
      
    }
    function setting()
    {
        add_settings_section("wcp-first-section", "I am title", null , "word-count");
        add_settings_field("wcp_location", "Display Location", array($this, "loadHTMl"), "word-count", "wcp-first-section");
        register_setting("wordCountPlugin", "wcp_location", array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => "0",
        ));

        add_settings_field("wcp_heading_title", "Heading Title", array($this, "loadHeadingTitleHTMl"), "word-count", "wcp-first-section");
        register_setting("wordCountPlugin", "wcp_heading_title", array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => null,
        ));

        add_settings_field("wcp_word_count", "Word count", array($this, "wordCountField"), "word-count", "wcp-first-section");
        register_setting("wordCountPlugin", "wcp_word_count", array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => "1",
        ));

        add_settings_field("wcp_charcter_count", "Charcter count", array($this, "charCountField"), "word-count", "wcp-first-section");
        register_setting("wordCountPlugin", "wcp_charcter_count", array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => "1",
        ));

        add_settings_field("wcp_readTime", "Read time", array($this, "wcp_readTimeField"), "word-count", "wcp-first-section");
        register_setting("wordCountPlugin", "wcp_readTime", array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => "1",
        ));
    }
    public function wcp_readTimeField()
    {
        ?>
        <input type="checkbox" name="wcp_readTime" value="1" <?php checked(get_option("wcp_readTime"),"1")?>/>
        <?php
    }
     function charCountField()
    {
        ?>
        <input type="checkbox" name="wcp_charcter_count" value="1" <?php checked(get_option("wcp_charcter_count"),"1")?>/>
        <?php
    }
    public function wordCountField()
    {
        ?>
        <input type="checkbox" name="wcp_word_count" value="1" <?php checked(get_option("wcp_word_count"),"1")?>/>
        <?php
    }
    public function loadHeadingTitleHTMl()
    {
        ?>
        <input type="text" name="wcp_heading_title" value="<?php echo  esc_attr(get_option("wcp_heading_title")) ?>" />
         <?php
    }
    function loadHTMl()
    {
        ?>
         <select name="wcp_location">
            <option value="0" <?php selected(get_option("wcp_location"),"0") ?>>Begnning of post</option>
            <option value="1" <?php selected(get_option("wcp_location"),"1") ?>>Ending  of post</option>
         </select>
        <?php
    }
    function adminPageOption()
    {
        add_options_page("Word Count", "word count", "manage_options", " word-count", array($this, "renderWordCountPage"));
    }
    function renderWordCountPage()
    {
?>
        <div class="wrap">
            <form action="options.php" method="POST">
                <?php 
                settings_fields("wordCountPlugin"); 
                do_settings_sections("word-count");
                submit_button();
                ?>
            </form>
        </div>
<?php
    }
}
$wordCountPlugin = new showCustomPluginInDashboard();
?>