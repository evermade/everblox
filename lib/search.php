<?php
namespace Evermade\Search;

use Evermade\Templates;

function makeSearch() {
    global $post;

    $json = [];
    $s = (isset($_GET['s']) ? $_GET['s'] : false);
    $lang = (isset($_GET['lang']) ? $_GET['lang'] : false);

    if (!$s) {
        return [];
    }

    $args = [
        'post_type' => get_post_types([
            'exclude_from_search' => false
        ]),
        'posts_per_page' => 30,
        's' => $s,
        'lang' => $lang
    ];

    $query = new \WP_Query($args);

    if (function_exists("relevanssi_do_query")) {
        relevanssi_do_query($query);
    }

    if (!empty( $query->posts ) ) {

        foreach($query->posts as $post){

            setup_postdata($post);
            $my_post = new \stdClass;

            $postType = get_post_type($post->ID);
            $postTypeObj = get_post_type_object($postType);

            $my_post->id = $post->ID;
            $my_post->type = $postType;
            $my_post->typeLabel = $postTypeObj->labels->singular_name;
            $my_post->timestamp = get_the_time('U', $post->ID);
            $my_post->title = $post->post_title;
            $my_post->excerpt = Templates\excerpt();
            $my_post->permalink = get_permalink($post->ID);

            array_push($json, $my_post);
        }
    }

    return $json;
}

add_action('rest_api_init', function() {
    register_rest_route( 'everblox/v1', '/search', array(
        'methods' => 'GET',
        'callback' => '\Evermade\Search\makeSearch',
    ) );
});
