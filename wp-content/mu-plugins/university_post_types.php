
<?php
/*
Plugin Name: Custom Post Type
Description: Used by millions, Custom post is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
Version: 1.0.0
Author: Mayank Parmar
License: GPLv2 or later
Text Domain: mayank
*/
 function university_post_types()
{
   register_post_type("event",array(
    "capability_type"=>"Events",
    "map_meta_cap"=>true,
    "has_archive"=>true,
    "supports"=>array("excerpt","editor","title","author","page-attributes","post-formats"),
    "rewrite"=>array("slug"=>"events"),
    "public"=>true,
    "show_in_rest"=>true,
    "labels"=>array(
      "name"=>"Events",
      "add_new_item"=>"Add New Event",
      "edit_item"=>"Edit Event",
      "all_items"=>"All Events",
      "singular_name"=>"Event"
    ),
    "menu_icon"=>"dashicons-calendar"
   ));

   register_post_type("program",array(
    "has_archive"=>true,
    "supports"=>array("excerpt","editor","title","author","page-attributes","post-formats"),
    "rewrite"=>array("slug"=>"programs"),
    "public"=>true,
    "show_in_rest"=>true,
    "labels"=>array(
      "name"=>"Programs",
      "add_new_item"=>"Add New Program",
      "edit_item"=>"Edit Program",
      "all_items"=>"All Programs",
      "singular_name"=>"Program",
      "menu_icon"=>"dashicons-calendar"
    ),
   ));
   register_post_type("professor",array(
    "supports"=>array("excerpt","editor","thumbnail"),
    "public"=>true,
    "show_in_rest"=>true,
    "labels"=>array(
      "name"=>"Professors",
      "add_new_item"=>"Add New Professor",
      "edit_item"=>"Edit Professor",
      "all_items"=>"All Professors",
      "singular_name"=>"Professor",
      "menu_icon"=>"dashicons-calendar"
    ),
   ));
   register_post_type("note",array(
    "capability_type"=>"Notes",
    "map_meta_cap"=>true,
    "supports"=>array("excerpt","editor","title","author","page-attributes","post-formats"),
    "public"=>false,
    "show_ui"=>true,
    "show_in_rest"=>true,
    "labels"=>array(
      "name"=>"notes",
      "add_new_item"=>"Add New Note",
      "edit_item"=>"Edit Note",
      "all_items"=>"All Notes",
      "singular_name"=>"Note",
      "menu_icon"=>"dashicons-calendar"
    ),
   ));

   register_post_type("like",array(
    "supports"=>array("editor","author"),
    "public"=>false,
    "show_ui"=>true,
    "labels"=>array(
      "name"=>"Likes",
      "add_new_item"=>"Add New Like",
      "edit_item"=>"Edit Like",
      "all_items"=>"All Likes",
      "singular_name"=>"Like",
      "menu_icon"=>"dashicons-calendar"
    ),
   ));
}

add_action("init","university_post_types");
?>