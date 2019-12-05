<?php
namespace Evermade\Templates;

use Evermade\Media;

function button($data = []) {
    global $app;

    $data = params([
        'url' => '',
        'title' => $app->getText('Read more'),
        'target' => '_self',
        'class' => '',
        'icon' => 'icon-arrow-right.svg',
        'iconPlacement' => 'after',
        'ariaLabel' => '',
    ], $data);

    $hasIcon = !!$data['icon'];

    $componentClass = className(
        "c-button",
        $hasIcon ? "c-button--icon-$data[iconPlacement]" : '',
        $data['class']
    );

    if ($data['url']) : ?>
        <a href="<?= $data['url'] ?>" target="<?= $data['target'] ?>" <?= $componentClass ?> <?= ariaLabel($data['ariaLabel']) ?>>
            <span class="c-button__title"><?= $data['title'] ?></span>

            <?php if ($hasIcon) : ?>
                <span class="c-button__icon"><?= Media\svg($data['icon']); ?></span>
            <?php endif; ?>
        </a>
    <?php else : ?>
        <div <?= $componentClass ?> role="button" <?= ariaLabel($data['ariaLabel']) ?>>
            <span class="c-button__title"><?= $data['title'] ?></span>

            <?php if ($hasIcon) : ?>
                <span class="c-button__icon"><?= Media\svg($data['icon']); ?></span>
            <?php endif; ?>
        </div>
    <?php endif;
}
