<?php
add_action("rest_api_init", "manageLikeRoute");
function manageLikeRoute()
{
    register_rest_route("university/vi", "manage-like", array(
        "methods" => "POST",
        "callback" => "addLiked"
    ));
    register_rest_route("university/vi", "manage-like", array(
        "methods" => "DELETE",
        "callback" => "deleteLike"
    ));
}
function addLiked($data)
{

    if (is_user_logged_in()) {
        $proffesor = sanitize_text_field($data['professor_id']);
        $existQuery = new WP_Query(array(
            "author" => get_current_user_id(),
            "post_type" => "like",
            "meta_query" => array(
                array(
                    "key" => "like_proffecor_id",
                    "compare" => "=",
                    "value" =>  $proffesor
                )
            )
        ));
        if ($existQuery->found_posts == 0 && get_post_type($proffesor) == "professor") {
            $response =   wp_insert_post(
                array(
                    "post_type" => "like",
                    "post_status" => "publish",
                    "post_title" => "my title",
                    "post_content" => "my content",
                    "meta_input" => array(
                        "like_proffecor_id" => $proffesor
                    )
                )
            );
            if ($response) {
                $message = array(
                    "message" => "successfully like a proffessor",
                    "success" => true

                );
                return $message;
            }
        } else {
            $invalidIdMessage = array(
                "message" => "invalid proffesor id",
                "success" => false
            );
            return $invalidIdMessage;
        }
    } else {
        $message = array(
            "message" => "only logged user can like proffessor",
            "success" => false

        );
        return $message;
    }
}
function deleteLike($data)
{
    if (is_user_logged_in()) {
        $likeid = sanitize_text_field($data['likeid']);
        if (get_current_user_id() == get_post_field("post_author", $likeid) && get_post_type($likeid) == "like"){
            wp_delete_post($likeid,true);
            $message = array(
                "message" => "successfully like a proffessor",
                "success" => true

            );
        return $message;
        }else{
            $invalidIdMessage = array(
                "message" => "invalid likes id",
                "success" => false
            );
            return $invalidIdMessage;
        }
           
    } else {
        $message = array(
            "message" => "only logged user can like proffessor",
            "success" => false

        );
        return $message;
    }
}
