<?php
namespace Evermade\Shortcodes;

use \Evermade\Templates;

function button($atts) {
    $atts = (shortcode_atts(array(
        'style' => '',
        'text' => 'Read more',
        'arialabel' => 'Go to page',
        'url' => '#'
    ), $atts));

    $style = $atts['style'];
    $text = $atts['text'];
    $ariaLabel = $atts['arialabel'];
    $url = $atts['url'];

    // If you need to convert style names to classes:
    $classes = [
        "Primary" => "",
        "Secondary" => "c-button--secondary",
        "Text Button" => ""
    ];

    $class = $classes[$style] ?? "";

    $params = [
        'url' => $url,
        'title' => $text,
        'target' => '_self',
        'class' => $class,
        'ariaLabel' => $ariaLabel
    ];

    \ob_start();
    if ($style === "Text Button") {
        Templates\textButton($params);
    } else {
        Templates\button($params);
    }
    return \ob_get_clean();
}

add_shortcode('button', 'Evermade\Shortcodes\button');
