<?php
namespace Evermade\Templates;

use Evermade\Media;

function searchToggle($data = []) {
    global $app;

    $data = params([
        'text' => $app->getText('Search'),
    ], $data); ?>

    <div class="c-search-toggle js-search-open" role="button" <?= ariaLabel($data['text']) ?>>
        <?= Media\svg('icon-search-dark.svg') ?>
    </div><?php
}
