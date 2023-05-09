<?php get_header();  ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri()."/assets/images/library-hero.jpg" ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">All Events!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    </div>
</div>
<div class="container">
    <ul  class="link-list min-list">
    <?php
   
   while (have_posts()) {
       the_post();
       $date=new DateTime(get_field("event_date"));
       ?>
     <li >
                   <a  href="<?php the_permalink() ?>">
                   <?php the_title() ?>
                   </a>
   </li>
  
       <?php
       # code...
       
   }
    ?>

    </ul>
    <hr class="section-break">
   
</div>

<?php get_footer(); ?>