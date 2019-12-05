<?php
namespace Evermade\Templates;

use Evermade\Media;

function customCardSmall($data = []) {
    global $app;

    $data = params([
        'image' => [],
        'title' => '',
        'text' => '',
        'link' => []
    ], $data);

    $image = Media\getImageData($data['image'], 'medium');

    $componentClass = className(
        "c-custom-card-small",
        !$image ? "c-custom-card-small--no-image" : "",
        !$data['text'] ? "c-custom-card-small--no-text" : "",
        !$data['link'] ? "c-custom-card-small--no-link" : ""
    ); ?>

    <div <?= $componentClass ?> data-style-color>
        <?php if ($data['link']) : ?>
            <a href="<?= $data['link']['url'] ?>" target="<?= $data['link']['target'] ?>" class="c-custom-card-small__link wrapper-link">
        <?php endif; ?>

            <?php if ($image) : ?>
                <div class="c-custom-card-small__image-wrapper">
                    <div class="c-custom-card-small__image" <?= style(
                        "background-image: url('$image[src]')"
                    ) ?>></div>
                </div>
            <?php endif; ?>

            <div class="c-custom-card-small__content">
                <h3 class="c-custom-card-small__title"><?= $data['title'] ?></h3>
                <div class="c-custom-card-small__text"><?= $data['text'] ?></div>

                <?php if ($data['link']) : ?>
                    <div class="c-custom-card__more">
                        <?php textButton(['title' => $data['link']['title']]) ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php if ($data['link']) : ?>
            </a>
        <?php endif; ?>
    </div><?php

    wp_reset_postdata();
}
