<?php
add_action("rest_api_init","feature_proffessor_api");
 function feature_proffessor_api()
{
    register_rest_route("feature/v1","proffessor",array(
        "methods"=>WP_REST_Server::READABLE, //GET METHOD
        "callback"=>"proffessor_api"
    ));
}
 function proffessor_api($data)
{
    $mainQuery=new WP_Query(array(
        "post_type"=>array("professor"),
        "page_id"=>$data["id"],
    ));
    $dataArray= array();
    while ( $mainQuery->have_posts()) {
        $mainQuery->the_post();
        $description=null;
        $getRelatedPrograms = get_field("related_pograms");
        $pograme=array();
        foreach ($getRelatedPrograms as $key => $programs) {
            array_push($pograme,array(
                "title"=>get_the_title($programs),
                "url"=>get_the_permalink($programs)
            ));
        }
            if(has_excerpt()){
                $description=get_the_excerpt();
            }
            else{
                $description=wp_trim_words(get_the_content(),15);
            }
            array_push($dataArray,array(
                "title"=>get_the_title(),
                "url"=>get_the_permalink(),
                "postType"=>get_post_type(),
                "authorName"=>get_the_author(),
                "description"=> $description,
                 "img"=>get_the_post_thumbnail_url(),
                "relatedPrograms"=>$pograme
            ));
        
    }
    if(count($mainQuery->posts) > 0){
        return $dataArray[0];
    }else{
        $message = array(
            "message" => "No data found",
            "success" => false

        );
        return $message;
    }
   
}

?>