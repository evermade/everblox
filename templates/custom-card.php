<?php
namespace Evermade\Templates;

use Evermade\Media;

function customCard($data = []) {
    global $app;

    $data = params([
        'image' => [],
        'title' => '',
        'text' => '',
        'link' => []
    ], $data);

    $image = Media\getImageData($data['image'], 'medium');

    if (!$image['src']) {
        $image['src'] = Media\fallbackImage('medium');
    }

    $componentClass = className(
        "c-custom-card",
        !$data['text'] ? "c-custom-card--no-text" : "",
        !$data['link'] ? "c-custom-card--no-link" : ""
    ); ?>

    <div <?= $componentClass ?>>
        <div class="c-custom-card__image-wrapper">
            <div class="c-custom-card__image" <?= style(
                "background-image: url('$image[src]')"
            ) ?>></div>
        </div>

        <?php if ($data['link']) : ?>
            <a href="<?= $data['link']['url'] ?>" target="<?= $data['link']['target'] ?>" class="c-custom-card__link wrapper-link">
        <?php endif; ?>

            <div class="c-custom-card__content">
                <h3 class="c-custom-card__title"><?= $data['title'] ?></h3>

                <?php if ($data['text']) : ?>
                    <div class="c-custom-card__text"><?= $data['text'] ?></div>
                <?php endif; ?>

                <?php if ($data['link']) : ?>
                    <div class="c-custom-card__more">
                        <?php textButton(['title' => $data['link']['title'], 'class' => 'c-text-button--color-light']) ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php if ($data['link']) : ?>
            </a>
        <?php endif; ?>
    </div>
    <?php
}
