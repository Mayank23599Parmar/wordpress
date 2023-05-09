<?php get_header(); ?>


<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri() . "/assets/images/ocean.jpg" ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title() ?></h1>
    <div class="page-banner__intro">
      <p>Learn how the school of your dreams got started.</p>
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

  <div class="page-links">
    <h2 class="page-links__title"><a href="#"><?php echo the_title() ?></a></h2>
    <ul class="min-list">
      <?php
      if ($theParent) {
        $findChildOf = $theParent;
      } else {
        $findChildOf = get_the_ID();
      }
      wp_list_pages(array(
        "title_li" => null,
        "child_of" => $findChildOf
      ));
      ?>
    </ul>
  </div>

  <div class="generic-content">
    <?php the_content() ?>
  </div>
</div>
<?php get_footer(); ?>