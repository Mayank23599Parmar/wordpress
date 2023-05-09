<?php
add_action("rest_api_init","our_custom_api");

function our_custom_api()
{
    register_rest_route("university/v1","search",array(
        "methods"=>WP_REST_Server::READABLE, //GET METHOD
        "callback"=>"api_callback"
    ));
}
 function api_callback($data)
{
    $mainQuery=new WP_Query(array(
        "post_type"=>array("post","program","event","professor"),
        "s"=>sanitize_text_field($data["query"])
    ));
    $dataArray= array(
        "blogs"=>array(),
        "pograms"=>array(),
        "events"=>array(),
        "professors"=>array()
    );
    while ( $mainQuery->have_posts()) {
        $mainQuery->the_post();
        if(get_post_type() == "post"){
            $description=null;
            if(has_excerpt()){
                $description=get_the_excerpt();
            }
            else{
                $description=wp_trim_words(get_the_content(),15);
            }
            array_push($dataArray["blogs"],array(
                "title"=>get_the_title(),
                "url"=>get_the_permalink(),
                "postType"=>get_post_type(),
                "image"=>get_the_post_thumbnail_url(0,"post-thumbnail"),
                "discription"=>$description,

            ));
        }
        if(get_post_type() == "program"){
            array_push($dataArray["pograms"],array(
                "title"=>get_the_title(),
                "url"=>get_the_permalink(),
                "postType"=>get_post_type(),
                "id"=>get_the_ID()
            ));
        }
        if(get_post_type() == "event"){
            array_push($dataArray["events"],array(
                "title"=>get_the_title(),
                "url"=>get_the_permalink(),
                "postType"=>get_post_type(),
                "date"=>date_format(new DateTime(get_field("event_date")),"Y/m/d H:i:s")
            ));
        }
        if(get_post_type() == "professor"){
            array_push($dataArray["professors"],array(
                "title"=>get_the_title(),
                "url"=>get_the_permalink(),
                "postType"=>get_post_type(),
                "authorName"=>get_the_author()
            ));
        }
    }
    $prograQuery=array("relation"=>"OR");
    foreach ($dataArray['pograms'] as  $value) {
        array_push($prograQuery,array(
            "key"=>"related_pograms",
             "compare"=>"Like",
             "value"=>'"'.$value['id'].'"',
        ));
        
    }
    $programProfessor=new WP_Query(array(
        "post_type"=>"professor",
         "meta_query"=> $prograQuery
        ));
       while ($programProfessor->have_posts()) {
        $programProfessor->the_post();
        if(get_post_type( ) == "professor"){
            array_push($dataArray["professors"],array(
                "title"=>get_the_title(),
                 "url"=>get_the_permalink(),
                 "postType"=>get_post_type(),
                 "authorName"=>get_the_author()
           ));
        }
          
       }
       $dataArray["professors"]=array_values(array_unique($dataArray["professors"],SORT_REGULAR));
   return $dataArray;
}
?>
