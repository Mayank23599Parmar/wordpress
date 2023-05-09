<?php
if (!is_user_logged_in()) {
    wp_redirect(site_url("/"));
    exit;
}
get_header();


?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri() . "/assets/images/ocean.jpg" ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title() ?></h1>
        <div class="page-banner__intro">
            <p>Take a note for lecture
        </div>
    </div>
</div>
<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <?php
            $theParent = wp_get_post_parent_id(get_the_ID());
            if ($theParent) {
            ?>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent) ?></a>
            <?php
            } else {
            ?>
                <a class="metabox__blog-home-link" href="/"><i class="fa fa-home" aria-hidden="true"></i> Back to Home</a>
            <?php
            }
            ?>
            <span class="metabox__main"> <?php echo the_title() ?></span>
        </p>
    </div>
    <div class="generic-content">
        <div class="create-notes-wrapper">
            <h1>Add new note</h1>
            <form class="create-note" data-id="<?php echo get_the_ID(); ?>">
            <input class="title-filed" placeholder="Enter Note title"/> 
            <textarea class="body-field" placeholder="Enter note content"> </textarea>
            <button>submit</button>
            </form>
        </div>
        <ul class="min-list link-list" id="my-note">
            <?php
            $userNote = new WP_Query(array(
                "post_type" => "note",
                "post_per_page" => -1,
                "author" => get_current_user_id()
            ));
            while ($userNote->have_posts()) {
                $userNote->the_post();
                ?>
                <li>
                    <input class="note-title-field" readonly value="<?php echo str_replace("Private: ","",wp_strip_all_tags(esc_attr(get_the_title()))) ?>" />
                    <span class="edit-note" data-id="<?php echo get_the_ID(); ?>"><i class="fa fa-pencil">Edit</i></span>
                    <span class="cancle-note hide" data-id="<?php echo get_the_ID(); ?>">cancle</span>
                    <span class="delete-note" data-id="<?php echo get_the_ID(); ?>"><i class="fa fa-trash">Delete</i></span>
                    <textarea class="note-body-field" readonly> <?php echo wp_strip_all_tags(esc_attr(get_the_content())) ?></textarea>
                    <span class="save-note hide" data-id="<?php echo get_the_ID(); ?>">Save</span>
                </li>
            <?php
            }
            wp_reset_postdata()
            ?>

        </ul>
    </div>
</div>
<?php get_footer() ?>