<?php get_header();  ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri()."/assets/images/library-hero.jpg" ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">All Events!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    </div>
</div>
<div class="container">
    <?php
   
    while (have_posts()) {
        the_post();
        $date=new DateTime(get_field("event_date"));
        ?>
      <div class="event-summary">
                    <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
                        <span class="event-summary__month"><?php echo $date->format("M") ; ?></span>
                        <span class="event-summary__day"><?php   echo $date->format("d") ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p> <?php echo wp_trim_words(get_the_content(),15) ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>
   
        <?php
        # code...
        
    }
     ?>
</div>

<?php get_footer(); ?>