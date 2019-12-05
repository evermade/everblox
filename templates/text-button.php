<?php
namespace Evermade\Templates;

use Evermade\Media;

function textButton($data = []) {
    global $app;

    $data = params([
        'url' => '',
        'title' => $app->getText('Read more'),
        'target' => '_self',
        'class' => '',
        'icon' => 'icon-arrow-right.svg',
        'iconPlacement' => 'after',
        'ariaLabel' => '',
        'hideTitleOnPhone' => false
    ], $data);

    $componentClass = className(
        "c-text-button",
        "c-text-button--icon-".$data['iconPlacement'],
        $data['class'],
        $data['hideTitleOnPhone'] ? "c-text-button--hide-title-on-phone" : ""
    );

    if ($data['url']) : ?>
        <a <?= permalink($data['url']) ?> target="<?= $data['target'] ?>" <?= $componentClass ?> <?= ariaLabel($data['ariaLabel']) ?>>
            <span class="c-text-button__title"><?= $data['title'] ?></span>
            <span class="c-text-button__icon"><?= Media\svg($data['icon']); ?></span>
        </a>
    <?php else : ?>
        <div <?= $componentClass ?> role="button" <?= ariaLabel($data['ariaLabel']) ?>>
            <span class="c-text-button__title"><?= $data['title'] ?></span>
            <span class="c-text-button__icon"><?= Media\svg($data['icon']); ?></span>
        </div>
    <?php endif;
}
