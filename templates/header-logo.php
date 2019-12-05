<?php
namespace Evermade\Templates;

function headerLogo($data = []) {
    $data = params([
        'href' => get_bloginfo('url'),
        'text' => get_bloginfo('name'),
    ], $data); ?>

    <div class="c-header-logo">
        <a href="<?= $data['href'] ?>" class="c-header-logo__image"><?= $data['text'] ?></a>
    </div><?php
}
