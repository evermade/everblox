<?php
namespace Evermade\Templates;

/**
 * Extract value from recursive array using dot notation. If no value is found, the default will be used.
 * Use to avoid isset hell.
 *
 * Example: value(['x' => ['y' => ['z' => 'Hello world!']]], 'x.y.z', 'Goodbye world')
 *
 * @param array $array
 * @param string $key
 * @param mixed $defaultValue
 */
function value(array $array = [], string $key = '', $defaultValue = false) {
  if (!empty($array)) {
    if (strpos($key, '.') > -1) {
      $levels = explode('.', $key);
      $value = $array;

      for ($level = 0; $level < count($levels); $level++) {
        $value = $value[$levels[$level]] ?? $defaultValue;
      }

      if (is_array($value) && empty($value)) {
        return $defaultValue;
      }

      return $value;
    }

    return $array[$key] ?? $defaultValue;
  }

  return $defaultValue;
}

/**
 * Create default parameters and merge supplied parameters with them.
 * A block with no sub fields always returns false instead of an empty array
 * in ACF, so don't make a strict type definition for $suppliedParams;
 *
 * @param array $defaultParams
 * @param $suppliedParams
 */
function params(array $defaultParams = [], $suppliedParams = []) {
    if (!is_array($suppliedParams)) {
        return $defaultParams;
    }

    return array_replace_recursive($defaultParams, array_filter($suppliedParams, function ($value) {
        /**
         * Booleans are a bit of an edge case for empty().
         * Empty arrays shouldn't overwrite defaults, so we want to use empty().
         */
        if (is_bool($value)) {
            return true;
        } else if (is_numeric($value)) { // Handle that pesky zero.
            return true;
        }

        return !empty($value);
    }));
}

/**
 * Template tags
 */

function className(...$args) {
    $classes = \esc_attr(join(" ", array_filter($args)));
    return "class=\"$classes\"";
}

function style(...$args) {
    $styles = htmlspecialchars(join("; ", array_filter($args)));

    return "style=\"$styles;\"";
}

function permalink($link = null) {
    if (!$link) {
        return get_the_permalink();
    }

    $link = \esc_attr($link);

    return "href=\"$link\"";
}

function excerpt(int $length = 30, string $more = '&hellip;') {
    $str = strip_shortcodes( get_the_content() );
    $str = apply_filters( 'the_content', $str );
    $str = str_replace(']]>', ']]&gt;', $str);
    $str_length = apply_filters( 'excerpt_length', $length );
    $str_more = apply_filters( 'excerpt_more', $more );

    return wp_trim_words( $str, $str_length, $str_more );
}

function email(string $email = '', string $class = '') {
    if (!$email) {
        return;
    }

    $email = antispambot($email);
    $email_link = sprintf('mailto:%s', $email);

    return sprintf('<a href="%s" class="%s">%s</a>', esc_url($email_link, array('mailto')), $class, esc_html($email));
}

function ariaLabel(string $text = '') {
    if ($text) {
        $text = \esc_attr($text);

        return "aria-label='$text'";
    }

    return;
}

function getTermIds(array $terms = []) {
    if ($terms) {
        $ids = [];

        foreach( $terms as $term ) {
            $ids[] = $term->term_id;
        }

        return $ids;
    }

    return;
}
