<?php
require get_theme_file_path("./custom-rest/custom-api.php");
require get_theme_file_path("./custom-rest/likes-manage.php");
require get_theme_file_path("./custom-rest/feature-proffessor-api.php");
function add_theme_scripts()
{
  $themeVersion = wp_get_theme()->get("Version");
  wp_enqueue_media();
  // add css files
  wp_enqueue_style("icons", "https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
  wp_enqueue_style("font-awsome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
  wp_enqueue_style("theme-style", get_theme_file_uri() . "/assets/build/index.css", false, $themeVersion, "all");
  wp_enqueue_style("style-index", get_theme_file_uri() . "/assets/build/style-index.css", false, $themeVersion, "all");

  // add javscript file

  wp_enqueue_script("theme-js", get_theme_file_uri() . "/assets/build/index.js", array('jquery'), $themeVersion, true);
  wp_enqueue_script("index-js", get_theme_file_uri() . "/build/index.js", false, $themeVersion, true);
}
//wp_enqueue_scripts for combine add style and script
function test()
{
  $themeVersion = wp_get_theme()->get("Version");
  wp_enqueue_script("main-university-js", get_theme_file_uri() . "/src/main.js", false, $themeVersion, true);
  wp_localize_script(
    "main-university-js",
    "siteData",
    array(
      'root_url' => get_site_url(),
      'nonce' => wp_create_nonce('wp_rest')
    )
  );
}
add_action("wp_enqueue_scripts", "test");
function university_features()
{
  add_theme_support("title-tag");
  add_image_size("professortLandscap", 440, 330, false);
}
add_action("wp_enqueue_scripts", "add_theme_scripts");
add_action("after_setup_theme", "university_features");
function university_adjust_queries($query)
{
  if (!is_admin() && is_post_type_archive("program") && $query->is_main_query()) {
    $query->set("orderby", "title");
    $query->set("order", "ASC");
    $query->set("posts_per_page", "-1");
  }
  if (!is_admin() && is_post_type_archive("event") && $query->is_main_query()) {
    $query->set("posts_per_page", "-1");
    $query->set("meta_key", "event_date");
    $query->set("orderby", "meta_value_num");
    $query->set("order", "ASC");
    $query->set(
      "meta_query",
      array(
        array(
          "key" => "event_date",
          "compare" => ">=",
          "value" => date("Ymd"),
          "type" => "numeric"
        )
      )
    );
  }
}

add_action("pre_get_posts", "university_adjust_queries");


function redirectToHomePage()
{
  $CuurentUser = wp_get_current_user();
  if ($CuurentUser->roles[0] == "subscriber" && count($CuurentUser->roles) == 1) {
    wp_redirect(site_url("/"));
  }
}
add_action("admin_init", "redirectToHomePage");

// hide admin bar for subcriber
add_action("wp_loaded", "hideAdminBar");
function hideAdminBar()
{
  $CuurentUser = wp_get_current_user();
  if ($CuurentUser->roles[0] == "subscriber" && count($CuurentUser->roles) == 1) {
    show_admin_bar(false);
  }
}


// custmize login screen

add_filter("login_headerurl", "ourHeaderUrl");
function ourHeaderUrl()
{
  return site_url("/");
}

add_filter("login_headertitle", "ourHeaderTitle");
function ourHeaderTitle()
{
  return get_bloginfo("name");
}

add_action("login_enqueue_scripts", "my_login_enqueues");
function my_login_enqueues()
{
  $themeVersion = wp_get_theme()->get("Version");
  wp_enqueue_style("style-index", get_theme_file_uri() . "/assets/build/style-index.css", false, $themeVersion, "all");
  wp_enqueue_style("login-style", get_theme_file_uri() . "/assets/build/index.css", false, $themeVersion, "all");
}
add_filter('wp_is_application_passwords_available', '__return_true');

// force post type note to private
function makeNotePrivate($data,$postArr)
{
  if (!$postArr["ID"] && count_user_posts(get_current_user_id(), "note") > 4 && $data["post_type"] == "note") {
    die("you are reach your maximum limit");
  }
  if ($data["post_type"] == "note" &&  $data["post_status"] != "trash") {
    $data["post_status"] = "private";
  }
  if ($data["post_type"] == "note") {
    $data["post_title"] = sanitize_text_field($data["post_title"]);
    $data["post_content"] = sanitize_text_field($data["post_content"]);
  }
  return $data;
}
add_filter('wp_insert_post_data', 'makeNotePrivate',10,2);
