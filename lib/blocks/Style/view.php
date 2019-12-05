<?php
namespace Evermade\Blocks\Style;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'color_scheme' => 'white-dark',
        'background_image' => [],
        'background_image_behavior' => 'cover',
    ], $data); ?>

    </div>
    <div
        <?= Templates\className(
        "style",
        "style--" . $data['color_scheme'],
        "style--image-" . $data['background_image_behavior']
        ) ?>
        <?= Templates\style(
            $data['background_image']
                ? "background-image: url(" . $data['background_image']['sizes']['large'] . ")"
                : ""
        ); ?>
    >
    <?php
}
