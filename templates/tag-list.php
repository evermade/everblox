<?php
namespace Evermade\Templates;

function tagList($data = []) {
    $data = params([
        'tags' => [],
        'separator' => '|'
    ], $data);

    if (empty($data['tags'])) {
        return false;
    } ?>

    <ul class="c-tag-list">
        <?php foreach ($data['tags'] as $k => $tag) :
            $url = get_tag_link($tag->term_id); ?>

            <li class="c-tag-list__item">
                <a href="<?= $url ?>" class="c-tag-list__link"><?= $tag->name ?></a>
            </li>

            <?php if ($k + 1 !== count($data['tags'])) : ?>
                <span class="c-tag-list__separator"><?= $data['separator'] ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul><?php
}
