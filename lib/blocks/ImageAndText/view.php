<?php
namespace Evermade\Blocks\ImageAndText;

use Evermade\Media;
use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'text' => '',
        'image' => null,
        'side_layout' => 'text-side-left',
        'stack_layout' => 'text-stack-bottom',
        'image_behavior' => 'contain',
    ], $data);

    $layoutClass = Templates\className(
        "l-image-and-text",
        $data['image_behavior'] === "contain" ? "collapse" : "no-collapse",
        "l-image-and-text--image-" . $data['image_behavior'],
        "l-image-and-text--" . $data['side_layout'],
        "l-image-and-text--" . $data['stack_layout']
    );

    $imageWrapperStyle = Templates\style(
        $data['image_behavior'] === "cover"
            ? "background-image: url(" . $data['image']['sizes']['large'] . ")"
            : ""
    ); ?>

    <section <?= $layoutClass ?>>
        <div class="l-image-and-text__container">
            <div class="l-image-and-text__image-wrapper" <?= $imageWrapperStyle ?>>
                <?php if ($data['image_behavior'] === 'contain') {
                    echo Media\image($data['image'], ['size' => 'medium', 'class' => 'l-image-and-text__image']);
                } ?>
            </div>
            <div class="l-image-and-text__text-wrapper">
                <div class="l-image-and-text__text wysiwyg" data-style-color>
                    <?= $data['text'] ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
