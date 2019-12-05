<?php
namespace Evermade\Templates;

use Evermade\Media;

function storySingle($data = []) {
    global $post;

    $post = $data;
    setup_postdata($post);

    $categories = get_the_category();
    $tags = get_the_tags();
    $featuredImage = get_post_thumbnail_id(); ?>

    <article <?= post_class("c-story-single") ?>>
        <header class="c-story-single__header">
            <h1 class="c-story-single__title"><?= get_the_title() ?></h1>
            <div class="c-story-single__meta">
                <div class="c-story-single__date"><?= get_the_date() ?></div>
                <div class="c-story-single__categories"><?php categoryList(['categories' => $categories, 'separator' => '|']) ?></div>
            </div>
        </header>

        <section class="c-story-single__content wysiwyg">
            <?php the_content(); ?>
        </section>

        <footer class="c-story-single__footer">
            <?php
            /**
             * @todo Implement a social sharing template and put it here
             */
            ?>
        </footer>
    </article><?php

    wp_reset_postdata();
}
