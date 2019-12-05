<?php
namespace Evermade\StringTranslations;

/**
 * This is a very basic helper for registering strings similar to using
 * the default __() and _e() functions.
 *
 * You can also do context specific manual registrations.
 */
function register(string $str = "") {
    if (!$str) {
        return false;
    }

    \pll_register_string($str, $str, 'Theme: Everblox');
}

if (function_exists("\pll_register_string")) {
    add_action('init', function() {
        register('Example translation');
        register('Welcome');
        register('Quick Links');
        register("We couldn't find any posts matching your filters.");
        register('Read more');
        register('Show more');
        register('Filter by');
        register('Categories');
        register('Content Type');
        register('Search');
        register('Type here');
        register('Filter results');
        register('All');
        register('Clear all');
        register("Sorry, we couldn't find any results.");
        register('Close search');
        register('Search');
        register('Type here...');
        register('Previous image');
        register('Next image');
        register('Toggle menu');
        register('Visit us on');
    });
}
