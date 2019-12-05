<?php
namespace Evermade\Blocks\Feed;

use \Evermade\Templates;

function getFeed($request) {
    global $app, $sitepress;

    // Insert the post types you want shown in the feed to the array below
    $postTypes = [
        'story'
    ];

    $lang = $currentLang = $request['lang'] ? $request['lang'] : 'en';

    /**
     * Multilingual support for WPML.
     */
    if (isset($sitepress)) {
        $currentLang = $sitepress->get_current_language();

        $sitepress->switch_lang($lang);
    }

    // Delete transient on development and staging environments
    if ($app->isDev() || $app->isStage()) {
        delete_transient($currentLang . 'feed');
    }

    // Use a transient if one exists
    $transient = get_transient($currentLang . 'feed');

    if ($transient !== false) {
        return $transient;
    }

    // Generate posts and filters
    $json = [
        'posts' => [],
        'filters' => []
    ];

    $args = [
        'post_type' => $postTypes,
        'posts_per_page' => -1
    ];

    /**
     * Multilingual support for Polylang.
     */
    if (function_exists("\pll_current_language")) {
        $args['lang'] = $lang;
    }

    $query = new \WP_Query($args);

    global $post;

    if (!empty($query->posts)) {
        foreach ($query->posts as $post) {
            setup_postdata($post);

            $myPost = new \stdClass;

            $myPost->id = $post->ID;
            $myPost->timestamp = get_the_time('U');
            $myPost->title = $post->post_title;
            $myPost->excerpt = Templates\excerpt(15, '...');
            $myPost->type = mapPostType($post->post_type);
            $myPost->categories = mapCategories(get_the_category());
            $myPost->tags = mapTags(get_the_tags());
            $myPost->permalink = get_permalink();
            $myPost->featuredImage = get_the_post_thumbnail_url($post->ID, 'small');

            /**
             * You can bind post type specific data to the data object here.
             * See below for a couple of examples.
             */
            // switch ($post->post_type) {
            //     case "event":
            //         $myPost->startDate = get_field('event_start_date_time');
            //         $myPost->endDate = get_field('event_end_date_time');
            //         $myPost->address = get_field('event_address');
            //         break;
            //     case "training":
            //         $myPost->displayPriority = get_field('training_display_priority');
            //         $myPost->address = get_field('training_address');
            //         break;
            // }

            array_push($json['posts'], $myPost);
            wp_reset_postdata();
        }

        $json['filters'] = getFiltersFromPosts($json['posts']);
    }

    /**
     * Multilingual support for WPML.
     */
    if (isset($sitepress)) {
        $sitepress->switch_lang($currentLang);
    }

    // Store feed result in a transient for faster response time
    set_transient($lang . 'feed', $json, 15 * MINUTE_IN_SECONDS);

    return $json;
}

/**
 * Loops through and generates the filter options from posts.
 *
 * @param array $posts Source of filters
 */
function getFiltersFromPosts($posts) {
    $categories = [];
    $types = [];
    $tags = [];

    if (!empty($posts)) {
        foreach($posts as $post) {
            $categories = setUniqueCategories($post->categories, $categories);
            $types = setUniqueType($post->type, $types);
            $tags = setUniqueTags($post->tags, $tags);
        }
    }

    return [
        'categories' => $categories,
        'types' => $types,
        'tags' => $tags
    ];
}

/**
 * Sets unique categories to a filter array
 *
 * @param array $categories Categories to add to filter array
 * @param array $array Contains all the unique filters
 */
function setUniqueCategories($categories, $array) {
    if (!empty($categories)) {
        foreach ($categories as $category) {
            if (!idInArray($category['id'], $array)) {
                array_push($array, $category);
            }
        }
    }

    return $array;
}

/**
 * Sets unique post types to a filter array
 *
 * @param array $type Type to add to filter array
 * @param array $array Contains all the unique filters
 */
function setUniqueType($type, $array) {
    if (isset($type) && !idInArray($type['id'], $array)) {
        array_push($array, $type);
    }

    return $array;
}

/**
 * Sets unique tags to a filter array
 *
 * @param array $tags Tags to add to filter array
 * @param array $array Contains all the unique filters
 */
function setUniqueTags($tags, $array) {
    if (!empty($tags)) {
        foreach ($tags as $tag) {
            if (!idInArray($tag['id'], $array)) {
                array_push($array, $tag);
            }
        }
    }

    return $array;
}

/**
 * Maps category objects to a better format for the app.
 *
 * @param array $categories Categories to map
 */
function mapCategories($categories) {
    if ($categories === false) return [];

    return array_map(function($c) {
        return [
            'id' => $c->slug,
            'name' => $c->name,
            'permalink' => get_category_link($c->term_id)
        ];
    }, $categories);
}

/**
 * Maps post type to a better format for the app.
 *
 * @param string $type Post type identifier
 */
function mapPostType($type) {
    $obj = get_post_type_object($type);

    return [
        'id' => $type,
        'name' => $obj->labels->name,
        'label' => $obj->labels->singular_name
    ];
}

/**
 * Maps tag objects to a better format for the app.
 *
 * @param array $tags Tags to map
 */
function mapTags($tags) {
    if ($tags === false) return [];

    return array_map(function($c) {
        return [
            'id' => $c->slug,
            'name' => $c->name,
            'permalink' => get_tag_link($c->term_id)
        ];
    }, $tags);
}

/**
 * Helper to see if an id exists in a multidimensional array
 *
 * @param string $id The needle to look for
 * @param array $array The heystack to look from
 */
function idInArray($id, $array) {
    $inArray = false;

    foreach($array as $x) {
        if ($x['id'] === $id) {
            $inArray = true;
            break;
        }
    }

    return $inArray;
}

add_action('rest_api_init', function() {
    register_rest_route('everblox/v1', '/feed', array(
        'methods' => 'GET',
        'callback' => '\Evermade\Blocks\Feed\getFeed'
    ));
});
