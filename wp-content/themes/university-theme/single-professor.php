<?php get_header(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri() . "/assets/images/ocean.jpg" ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title() ?></h1>
    </div>
</div>
<div class="container">
    <div class="singe-post mt-4">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail(); ?>
                </div>

                <div class="two-third">
                    <?php
                    $likeCount = new WP_Query(array(
                        "post_type" => "like",
                        "meta_query" => array(
                            array(
                                "key" => "like_proffecor_id",
                                "compare" => "=",
                                "value" => get_the_ID()
                            )
                        )
                    ));
                    $existStatus="no";
                if(is_user_logged_in()){
                    $existQuery = new WP_Query(array(
                        "author"=>get_current_user_id(),
                        "post_type" => "like",
                        "meta_query" => array(
                            array(
                                "key" => "like_proffecor_id",
                                "compare" => "=",
                                "value" => get_the_ID()
                            )
                        )
                    ));
                    if($existQuery->found_posts){
                        $existStatus ="yes";
                    }
                }
                    ?>
                    <span class="like-box" data-likeid="<?php echo $existQuery->posts[0]->ID  ?>" data-profesorid="<?php the_ID() ?>" data-exists="<?php echo $existStatus  ?>">
                        <i class="fa fa-heart-o"></i>
                        <i class="fa fa-heart"></i>
                        <span class="like-count"><?php echo $likeCount->found_posts ?></span>
                    </span>
                    <?php the_content() ?>
                </div>
            </div>


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