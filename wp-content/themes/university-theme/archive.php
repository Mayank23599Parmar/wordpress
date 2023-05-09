<?php get_header();  ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri() . "/assets/images/library-hero.jpg" ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">
            <?php
            if (is_category()) {
                single_cat_title();
            }
            if (is_author()) {
                the_author();
            }
            ?>
        </h1>
        <h2 class="headline headline--medium">
            <?php
            if (is_category()) {
                single_cat_title();
            }
            if (is_author()) {
                the_author();
            }
            ?>
        </h2>
    </div>
</div>
<div class="container">
    <?php
    while (have_posts()) {
        the_post()
    ?>
        <div class="post-item">
            <h1 class="headline headline--post headline--medium"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
            <div class="metabox">
                <p>Posted by
                    <a href="/wordpress/author/<?php echo get_author_name() ?>"><?php echo get_author_name() ?></a> on <?php the_time('F j, Y') ?> in <?php echo get_the_category_list(",") ?>
                </p>
            </div>
            <div class="generic-content">
                <?php the_excerpt() ?>
                <p><a class="btn btn--blue" href="<?php the_permalink() ?>">Continue..</a></p>
            </div>
        </div>
    <?php
    }
    echo paginate_links();
    ?>
</div>

<?php get_footer(); ?>