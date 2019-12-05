<?php
namespace Evermade;

require('classes/class.application.php');
require('classes/class.block.php');

require_once('lib/development.php');
require_once('lib/helpers.php');
require_once('lib/templates.php');
require_once('lib/media.php');
require_once('lib/search.php');
require_once('lib/dashboard.php');
require_once('lib/image-sizes.php');
require_once('lib/string-translations.php');

/**
 * Load other functionalities.
 * @todo These are mostly legacy, we should have a lookthrough
 * all these to see what to keep.
 */

require_once('lib/security.php');
require_once('lib/post-types.php');
require_once('lib/hooks.php');
require_once('lib/shortcodes.php');

/**
 * Setup the global application instance.
 */

global $app;

$app = new Application();

$app->configure([
    'blacklistedBlocks' => ['Example'],
    'templates' => glob(__DIR__ . '/templates/*.php'),
    'blocks' => glob(__DIR__ . '/lib/blocks/*/index.php'),
    'asciiEnabled' => false,
]);

$app->enablePagebuilder([
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'default',
            ],
        ],
    ]
]);

$siteurl = get_site_url();

add_action('wp_enqueue_scripts', function () use ($app, $siteurl) {
    wp_deregister_script('jquery'); // Deregister core jquery. This might break 3rd party plugins.
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', [], null, false);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Karla:400,700|Work+Sans:400,700');

    $app->enqueueFromManifest('frontend.js', 'client', ['jquery']);

    wp_localize_script("em-frontend.js", "emScriptData", [
        "path" => str_replace($siteurl, "", get_stylesheet_directory_uri()),
        "siteurl" => $siteurl,
        "lang" => $app->getLanguage(),
    ]);

    /**
     * Feed block React configuration.
     */
    wp_localize_script("em-frontend.js", "emFeedConfig", [
        'apiUrl' => get_rest_url(null, 'everblox/v1/feed?lang='.$app->getLanguage()),
        'text' => [
            'notFound' => $app->getText("We couldn't find any posts matching your filters."),
            'readMore' => $app->getText('Read more'),
            'loadMore' => $app->getText('Show more'),
            'filtersTitle' => $app->getText('Filter by'),
            'categoriesTitle' => $app->getText('Categories'),
            'typesTitle' => $app->getText('Content Type'),
            'searchTitle' => $app->getText('Search'),
            'searchPlaceholder' => $app->getText('Type here'),
            'searchAriaLabel' => $app->getText('Filter results'),
            'selectAll' => $app->getText('All'),
            'selectClear' => $app->getText('Clear all')
        ],
        'svg' => [
            'arrowRight' => \Evermade\Media\svg('icon-arrow-right.svg')
        ]
    ]);

    /**
     * Search configuration.
     */
    wp_localize_script("em-frontend.js", "emSearchConfig", [
        'apiUrl' => get_rest_url(null, 'everblox/v1/search'),
        'language' => $app->getLanguage(),
        'minLength' => $app->getOption('opt_search_minimum_length', 3),
        'text' => [
            'noResults' => $app->getOption('opt_search_no_results_text', $app->getText("Sorry, we couldn't find any results.")),
            'readMore' => $app->getText('Read more')
        ]
    ]);

    $app->enqueueFromManifest('frontend.css', 'client', []);
});

add_action('admin_enqueue_scripts', function () use ($app, $siteurl) {
    wp_enqueue_style('google-fonts-admin', 'https://fonts.googleapis.com/css?family=Karla:400,700|Work+Sans:400,700');

    $app->enqueueFromManifest('admin.js', 'admin', ['jquery']);
    $app->enqueueFromManifest('admin.css', 'admin', []); // Admin assets are not built with WDS, and can be always enqueued.

    wp_localize_script("em-admin.js", "emScriptData", [
        "path" => str_replace($siteurl, "", get_stylesheet_directory_uri()), // Useful for lazyloading
        "siteurl" => $siteurl, // Required by devtooling
        "lang" => $app->getLanguage(),
    ]);

    add_editor_style(
        $app->themeDir . "/dist/" . $app->getFilenameFromManifest('editor.css', 'admin')
    );
});

add_filter('mce_external_plugins', function ($plugins) use ($app) {
    $file = $app->getFilenameFromManifest('editor.js', 'admin');
    $plugins['custom_mce_em_buttons'] = $app->themeDir . "/dist/$file";

    return $plugins;
});

/**
 * Create the ACF options pages.
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Options',
        'menu_title'    => 'Options',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Default Page Blocks',
        'menu_title'    => 'Default Page Blocks',
        'parent_slug'   => 'theme-general-settings'
    ));
}

/**
 * Remove unneeded menu items
 */
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
});

/**
 * Add story post type as default on the WP XML feed
 */
add_filter('request', function ($feed) {
    if (isset($feed['feed']) && !isset($feed['post_type']) ) {
       $feed['post_type'] = ['story'];
   }

   return $feed;
});

/**
 * Add a default favicon
 *
 * This is just a sample favicon, you should upload the actual site
 * favicon through Appearance > Customize in the WordPress admin.
 */
add_action( 'wp_head', function() {
    if(!has_site_icon() && !is_customize_preview()) {
        echo '<link rel="shortcut icon" href="'. get_stylesheet_directory_uri() . '/assets/img/everblox-favicon.png" />';
    }
}, 99 );

/**
 * Restrict Menu depth to 1
 */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( $hook != 'nav-menus.php' ) return;
    wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 2;', 'after' );
});

/**
 * Add support for Polylang translations on ACF options pages, apparently WPML works out of the box but not Polylang
 *
 * https://stackoverflow.com/questions/53611294/
 */
add_filter('acf/settings/default_language', function ( $lang ) {
    if( $lang == "" && function_exists('pll_default_language') ) {
        $lang = pll_default_language();
    }
    return $lang;
});

add_filter('acf/settings/current_language', function ( $lang ) {
    if( function_exists('pll_default_language') ){
        $lang = pll_current_language();
        return $lang;
    }
});
