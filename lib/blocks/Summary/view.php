<?php
namespace Evermade\Blocks\Summary;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'layout' => 'grid',
        'header' => '',
        'content' => '',
        'display' => 'automatic',
        'number_of_items' => 12,
        'categories' => [],
        'tags' => [],
        'manual_items' => [],
        'custom_items' => []
    ], $data);

    $layoutTemplates = [
        'grid' => '\\Evermade\\Templates\\summaryGrid',
        'carousel' => '\\Evermade\\Templates\\summaryCarousel',
        'list' => '\\Evermade\\Templates\\summaryList'
    ];

    $items = [];

    if ($data['display'] === 'automatic') {
        $args = [
            'post_type' => $data['content'],
            'posts_per_page' => $data['number_of_items'],
            'category__in' => $data['categories'],
            'tag__in' => $data['tags']
        ];

        $query = new \WP_Query($args);

        $items = $query->posts;
    } elseif ($data['manual_items'] && $data['custom_items']) {
        $items = array_merge($data['manual_items'], $data['custom_items']);
    } else if ($data['manual_items']) {
        $items = $data['manual_items'];
    } else if ($data['custom_items']) {
        $items = $data['custom_items'];
    } else {
        return false; // Disable the whole block template if there are no items
    }

    $layoutClass = Templates\className(
        "l-summary",
        "l-summary--$data[layout]",
        "collapse"
    ); ?>

    <section <?= $layoutClass ?>>
        <?php $layoutTemplates[$data['layout']]([
            'header' => $data['header'],
            'items' => $items
        ]); ?>
    </section>
<?php
}
