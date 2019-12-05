<?php
namespace Evermade\Templates;

function categoryList($data = []) {
    $data = params([
        'categories' => [],
        'separator' => '|'
    ], $data);

    if (empty($data['categories'])) {
        return false;
    } ?>

    <ul class="c-category-list">
        <?php foreach ($data['categories'] as $k => $category) :
            $url = get_category_link($category->term_id); ?>

            <li class="c-category-list__item">
                <a href="<?= $url ?>" class="c-category-list__link"><?= $category->name ?></a>
            </li>

            <?php if ($k + 1 !== count($data['categories'])) : ?>
                <span class="c-category-list__separator"><?= $data['separator'] ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul><?php
}
