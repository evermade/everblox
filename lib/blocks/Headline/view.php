<?php
namespace Evermade\Blocks\Headline;

use Evermade\Templates;
use Evermade\Media;

function template($data = []) {
    global $app;

    $data = Templates\params([
        'headline' => '',
        'text' => '',
        'buttons' => [],
        'background_image' => null,
        'background_video' => 'none',
        'vimeo_video_id' => null,
        'youtube_video_id' => null,
        'image' => null,
        'vertical_spacing' => 'content',
        'overlay_opacity' => 40,
        'image_align' => 'middle',
        'button_color' => 'dark'
    ], $data);

    $videoIds = [
        'vimeo' => $data['vimeo_video_id'],
        'youtube' => $data['youtube_video_id']
    ];

    $videoId = $videoIds[$data['background_video']] ?? '';
    $overlayOpacity = $data['overlay_opacity'] / 100;
    $hasImage = $data['image'] && $data['image'] !== '';

    $layoutClass = Templates\className(
        "l-headline",
        $hasImage ? "l-headline--has-image" : "",
        $hasImage ? "l-headline--image-align-" . $data['image_align'] : "",
        "l-headline--spacing-" . $data['vertical_spacing']
    ); ?>

    <section <?= $layoutClass ?>>
        <div class="l-headline__wrapper">
            <div class="l-headline__background">
                <?php Templates\backgroundImage(['image' => $data['background_image'], 'size' => 'large']) ?>
                <?php Templates\backgroundVideo(['type' => $data['background_video'], 'id' => $videoId]) ?>
                <?php Templates\overlay(['opacity' => $overlayOpacity]) ?>
            </div>
            <div class="l-headline__container">
                <div class="l-headline__text">
                    <?php Templates\headlineTextButtons($data); ?>
                </div>
            </div>
            <?php if ($hasImage) : ?>
                <div class="l-headline__image-wrapper">
                    <?= Media\image($data['image'], ['class' => 'l-headline__image', 'size' => 'medium']) ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php
}
