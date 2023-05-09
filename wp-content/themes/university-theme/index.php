<?php get_header();  ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri()."/assets/images/library-hero.jpg" ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome to our blogs!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
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
           <?php the_author_link() ?> on <?php the_time('F j, Y') ?> in <?php echo get_the_category_list(",") ?></p>
        </div>
        <div class="generic-content">
            <?php the_excerpt() ?>
            <p><a class="btn btn--blue" href="<?php the_permalink() ?>">Continue..</a></p>
        </div>
        
        </div>
   
        <?php
        # code...
        
    }
    echo paginate_links();
     ?>
</div>

<?php get_footer(); ?>