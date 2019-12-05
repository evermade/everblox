<?php
namespace Evermade\Blocks\ImageGallery;

use Evermade\Templates;
use Evermade\Media;

function template($data = []) {
    global $app;

    $data = Templates\params([
        'images' => [],
    ], $data);

    $initialCaption = ""; ?>

    <section class="l-image-gallery collapse js-image-carousel">
        <div class="l-image-gallery__container">
            <div class="l-image-gallery__items js-image-carousel-items">

                <?php foreach ($data['images'] as $k => $item) :
                    if ($k === 0) {
                        $initialCaption = $item['caption'];
                    } ?>
                    <div class="l-image-gallery__item" data-caption="<?= $item['caption'] ?>">
                        <div class="l-image-gallery__item-background"></div>
                        <?= Media\image($item['image'], ['size' => 'large', 'class' => 'c-fit-viewport']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="l-image-gallery__controls" data-style-color>
                <?php if (count($data['images']) > 1) : ?>
                    <div class="l-image-gallery__previous">
                        <?php Templates\textButton([
                            'url' => '',
                            'class' => 'js-image-carousel-previous c-text-button--no-margin',
                            'title' => $app->getText('Previous image'),
                            'icon' => 'icon-arrow-left.svg',
                            'iconPlacement' => 'before',
                            'hideTitleOnPhone' => true
                        ]) ?>
                    </div>
                <?php endif; ?>
                <div class="l-image-gallery__caption">
                    <p class="c-caption c-caption--center js-image-carousel-caption"><?= $initialCaption ?></p>
                </div>
                <?php if (count($data['images']) > 1) : ?>
                    <div class="l-image-gallery__next">
                        <?php Templates\textButton([
                            'url' => '',
                            'class' => 'js-image-carousel-next c-text-button--no-margin',
                            'title' => $app->getText('Next image'),
                            'icon' => 'icon-arrow-right.svg',
                            'hideTitleOnPhone' => true
                        ]) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
}
