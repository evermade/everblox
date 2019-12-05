<?php
namespace Evermade\Media;

use Evermade\Templates;

/**
 * Get a webpack optimized SVG.
 * @todo Currently getting the filename from manifest is buggy when developing.
 *
 * svg('icon-facebook.svg')
 */
function svg(string $name, array $args = []) {
    global $app;

    $themeDir = $app->themeDirOnServer;
    $args = Templates\params([
        'viewbox' => '0 0 50 50', // Only used with sprites
        'wrapperclass' => 'h-svg__inline',
    ], $args);
    $wrapper = function($svgEl) use ($args) {
        // Disabled wrapper for now as it was causing some weird CSS issues
        // return "<div class='h-svg $args[wrapperclass]'>$svgEl</div>";

        return $svgEl;
    };

    // if (strpos($name, '#') === 0) {
    //     // If $name begins with #, it's a sprite
    //     // This is just boilerplate code at the moment, sprite gen is not configured yet.

    //     $filename = $app->getFilenameFromManifest('sprites.svg');
    //     $svg = $themeDir . "/dist/$filename";
    //     return $wrapper("
    //         <svg class='use-tag' viewbox='$args[viewbox]'>
    //             <use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='{$svg}{$path}'>
    //             </use>
    //         </svg>
    //     ");
    // }

    $filename = $app->getFilenameFromManifest($name);

    // Temporary fix to the above @todo
    if ($app->isDev()) {
        $filename = $name;
    }

    $fullPath = $themeDir . "/dist/$filename";

    return $wrapper(file_get_contents($fullPath));
}

/**
 * Get an image from WP media library. Optionally supports srcset and captions.
 */
function image($image = null, array $args = []) {
    $args = Templates\params([
        'size' => 'medium',
        'class' => 'h-image',
        'showCaption' => false,
        'responsive' => true,
        'sizes' => null,
    ], $args);

    $image = getImageData($image, $args['size']);

    if (!$image) {
        return false;
    }

    $img = "<img src='$image[src]' class='$args[class]' alt='$image[alt]' ";

    if ($args['responsive']) {
        $img .= "srcset='$image[srcset]' sizes='$args[sizes]' ";
    }

    if ($image['title']) {
        $img .= "title='$image[title]' ";
    }

    $img .= '>';

    if ($args['showCaption'] && $img['caption']) {
        return "
          <figure class='h-captioned-figure'>
            $img

            <figcaption class='h-captioned-figure__caption'>
                $img[caption]
            </figcaption>
          </figure>
        ";
    }

    return $img;
}

/**
 * Get the fallback image. This should be set in the Options for each
 * project specifically. Ask your designer to create this if none is available!
 */
function fallbackImage(string $size = 'medium') {
    $image = \get_field('opt_fallback_image', 'options');

    if (!$image) {
        return false;
    }

    return $image['sizes'][$size];
}

/**
 * Get the placeholder image size. Useful for creating low resolution
 * image load placeholders.
 */
function placeholder($image) {
    if ($image['sizes'] && $image['sizes']['placeholder']) {
        return $image['sizes']['placeholder'];
    }

    return false;
}

/**
 * Get an image from WP media library and return the most relevant data.
 *
 * Don't do this: image(getImageData($imageId))
 */
function getImageData($image = null, string $size = 'medium') {
    if (is_array($image)) { // Assume ACF
        $id = $image['ID'];
    } else if (is_numeric($image)) { // Image ID
        $id = absint($image);
    } else {
      // Throwing is a bad idea, as it makes this function hard to use directly
      // throw new \Exception('Unrecognized data type for image');
      return false;
    }

    $attachment = get_post($id);
    $data = [
        'src' => wp_get_attachment_image_url($id, $size),
        'srcset' => wp_get_attachment_image_srcset($id, $size),
        'alt' => get_post_meta($id, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'title' => $attachment->post_title
    ];

    return $data;
}
