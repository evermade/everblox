<?php
namespace Evermade\Templates;

use Evermade\Media;

function searchField($data = []) {
    global $app;

    $data = params([
        'title' => $app->getOption('opt_search_title', $app->getText("Search")),
        'label' => $app->getOption('opt_search_label', $app->getText("Type here..."))
    ], $data); ?>

    <div class="c-search-field">
        <h3 class="c-search-field__title"><?= $data['title'] ?></h3>

        <label for="site-search-input" class="c-search-field__label"><?= $data['label'] ?></label>
        <input id="site-search-input" type="text" class="c-search-field__input js-search-input" />
    </div><?php
}
