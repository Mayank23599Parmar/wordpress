<?php get_header(); ?>
<?php
$bannerImage=get_theme_file_uri() . "/assets/images/ocean.jpg";
if(get_field("paga_banner")){
    $bannerImage=get_field("paga_banner")["url"];
}
?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $bannerImage ;?>)"></div>
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
    <h1>Related proffesor</h1>
    <ul class="link-list min-list">
        <?php

        $proffesorQuery = new WP_Query(
            array(
                "posts_per_page" => -1,
                'post_type' => 'professor',
                "meta_query" => array(
                    array(
                        "key" => "related_pograms",
                        "compare" => "LiKE",
                        "value" =>  '"' . get_the_ID() . '"'
                    )
                )
            )
        );
        while ($proffesorQuery->have_posts()) {
            $proffesorQuery->the_post();
        ?>
            <li>
                <a href="<?php the_permalink() ?>">
                    <?php the_title() ?>
                </a>
            </li>
        <?php
            # code...
        }
        wp_reset_postdata()
        ?>


    </ul>
    <h1>Related events</h1>
    <?php
    $relatedEventsQuery = new WP_Query(array(
        "posts_per_page" => -1,
        'post_type' => 'event',
        "meta_query" => array(
            array(
                "key" => "related_pograms",
                "compare" => "LiKE",
                "value" =>  '"' . get_the_ID() . '"'
            )
        )
    ));
    while ($relatedEventsQuery->have_posts()) {
        $relatedEventsQuery->the_post();
    ?>
        <li>
            <a href="<?php the_permalink() ?>">
                <?php the_title() ?>
            </a>
        </li>
    <?php
        # code...
    }
    wp_reset_postdata();
    # code...
    ?>
</div>
<?php get_footer(); ?>