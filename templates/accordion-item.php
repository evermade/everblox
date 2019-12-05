<?php
namespace Evermade\Templates;

use Evermade\Media;

function accordionItem($data = []) {
    $data = params([
        'title' => '',
        'content' => ''
    ], $data);

    if (!$data['title']) {
        return false;
    } ?>

    <div class="c-accordion-item">
        <h3 tabindex="0" role="button" class="c-accordion-item__title js-accordion-toggle" aria-expanded="false"><?= $data['title'] ?></h3>
        <div class="c-accordion-item__content wysiwyg js-accordion-content" aria-hidden="true"><?= $data['content'] ?></div>
    </div><?php
}
