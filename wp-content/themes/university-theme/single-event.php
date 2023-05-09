<?php get_header(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri() . "/assets/images/ocean.jpg" ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title() ?></h1>
    </div>
</div>
<div class="container">
    <div class="singe-post">
        <div class="content">
            <?php the_content() ?>
        </div>
    </div>

   
    <h1>Related programs</h1>
    <ul class="link-list min-list">
        <?php
        $getRelatedPrograms = get_field("related_pograms");
        foreach ($getRelatedPrograms as $key => $programs) {
            # code...
        ?>
            <li>
                <a href="<?php echo get_the_permalink($programs) ?>">
                    <?php echo get_the_title($programs); ?>
                </a>
            </li>

        <?php
        }
        //print_r($getRelatedPrograms);
        ?>
</div>
</ul>
<?php get_footer(); ?>