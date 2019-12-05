<?php
namespace Evermade\Templates;

function relatedItems($data = []) {
    $data = params([
        'post' => [],
        'postType' => [],
        'numberOfItems' => 3,
        'title' => ''
    ], $data);

    global $post;

    $post = $data['post'];
    setup_postdata($post);

    $postType = $data['postType'] ? $data['postType'] : get_post_type();

    $args = [
        'post__not_in' => [$post->ID],
        'post_type' => $postType,
        'posts_per_page' => $data['numberOfItems']
    ];

    $query = new \WP_Query($args);

    $items = $query->posts;

    if ($items) : ?>
        <div class="l-related-items">
            <?php if ($data['title']) : ?>
                <div class="l-related-items__title">
                    <h3><?= $data['title'] ?></h3>
                </div>
            <?php endif; ?>

            <div class="l-related-items__wrapper">
                <?php foreach ($items as $k => $item) :

                    // get the item template
                    $itemPostType = get_post_type($item->ID);
                    $template =  __NAMESPACE__ . "\\" . $itemPostType . "Card";

                    if (!function_exists($template)) {
                        $template = __NAMESPACE__ . "\storyCard";
                    } ?>

                    <div class="l-related-items__item">
                        <?php $template($item) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; wp_reset_postdata();
}
