<?php
namespace Evermade\Templates;

use Evermade\Media;

function storyCard($data = []) {
    global $post, $app;

    $post = $data;
    setup_postdata($data);

    $categories = get_the_category();
    $tags = get_the_tags();
    $featuredImage = Media\getImageData(get_post_thumbnail_id(), 'small');

    $componentClass = className(
        "c-story-card",
        !$featuredImage ? "c-story-card--no-image" : ""
    ); ?>

    <div <?= $componentClass?>>
        <a href="<?= permalink() ?>" class="c-story-card__link wrapper-link">
            <?php if ($featuredImage) : ?>
                <div class="c-story-card__image-wrapper">
                    <div class="c-story-card__image" <?= style(
                        "background-image: url($featuredImage[src])"
                    ) ?>></div>
                </div>
            <?php endif; ?>

            <div class="c-story-card__content">
                <h3 class="c-story-card__title"><?= get_the_title() ?></h3>
                <div class="c-story-card__excerpt"><?= excerpt(15, '...') ?></div>
                <div class="c-story-card__more">
                    <?php textButton(['title' => $app->getText('Read more')]) ?>
                </div>
            </div>
        </a>

        <div class="c-story-card__categories">
            <?php categoryList(['categories' => $categories]) ?>
        </div>

        <div class="c-story-card__tags">
            <?php tagList(['tags' => $tags]) ?>
        </div>
    </div><?php

    wp_reset_postdata();
}
