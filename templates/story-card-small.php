<?php
namespace Evermade\Templates;

use Evermade\Media;

function storyCardSmall($data = []) {
    global $post, $app;

    $post = $data;
    setup_postdata($post);

    $categories = get_the_category();
    $featuredImage = Media\getImageData(get_post_thumbnail_id(), 'extra-small');

    $componentClass = className(
        "c-story-card-small",
        !$featuredImage ? "c-story-card-small--no-image" : ""
    );

    $imageStyle = style(
        "background-image: url('$featuredImage[src]')"
    ); ?>

    <div <?= $componentClass ?> data-style-color>
        <a href="<?= permalink() ?>" class="c-story-card-small__link wrapper-link">

            <?php if ($featuredImage) : ?>
                <div class="c-story-card-small__image-wrapper">
                    <div class="c-story-card-small__image" <?= $imageStyle ?>></div>
                </div>
            <?php endif; ?>

            <div class="c-story-card-small__content">
                <div class="c-story-card-small__text">
                    <h3 class="c-story-card-small__title"><?= get_the_title() ?></h3>

                    <div class="c-story-card-small__more">
                        <?php textButton(['title' => $app->getText('Read more')]) ?>
                    </div>
                </div>
            </div>
        </a>

        <div class="c-story-card-small__categories">
            <?php categoryList(['categories' => $categories]) ?>
        </div>
    </div><?php

    wp_reset_postdata();
}
