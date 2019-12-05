<?php namespace Evermade\Hooks;

// Disable the absurd margin-top: 32px !important inline css from WP
add_action('get_header', function() {
    remove_action('wp_head', '_admin_bar_bump_cb');
});

// lets add feature image to posts by default
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

// add custom classes to tinyMCE editor body
add_filter( 'tiny_mce_before_init', function($mce) {
    $mce['body_class'] .= ' wysiwyg';

    return $mce;
});

// remove wp top bar stuff
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('wpseo-menu');
}, 999);

// hide update nags
add_action('admin_menu', function() {
    remove_action('admin_notices', 'update_nag', 3); // update notice at the top of the screen
    remove_filter('update_footer', 'core_update_footer'); // update notice in the footer
});

// menus
add_action('init', function() {
    register_nav_menus(
        array(
            'header-navigation' => 'Header Navigation',
            'footer-navigation' => 'Footer Navigation'
        )
    );
});

// register new buttons in the editor
function registerMceButton($buttons)
{
    array_push($buttons, 'custom_mce_em_button');

    return $buttons;
}

function registerMceLorem($buttons)
{
    array_push($buttons, 'custom_mce_em_lorem');

    return $buttons;
}

add_action('admin_head', function() {
    // Check if user has the right permissions
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    // Check if WYSIWYG is enabled then add filters
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_buttons', '\Evermade\Hooks\registerMceButton');
        add_filter('mce_buttons', '\Evermade\Hooks\registerMceLorem');
    }
});

// Add local languages for the everblox text domain
add_action('after_setup_theme', function() {
    load_theme_textdomain('everblox', get_template_directory() . '/languages');
});

// Lower the display priority of Yoast SEO meta box
add_filter('wpseo_metabox_prio', function($html) {
    return 'low';
});

// Add responsive video wrapper around youtube and vimeo embeds
add_filter( 'embed_oembed_html', function($cache, $url, $attr, $post_ID) {
    if (false !== strpos($url, 'youtube.com') || false !== strpos($url, 'vimeo.com')) {
        return '<div class="responsive-container">' . $cache . '</div>';
    }

    return $cache;
}, 99, 4 );
