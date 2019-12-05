<?php
namespace Evermade\Templates;

function searchModal($data = []) {
    global $app; ?>

    <div class="l-search-modal js-search-modal">
        <div class="l-search-modal__container">
            <div class="l-search-modal__field">
                <?php searchField(); ?>
            </div>
            <div class="l-search-modal__results">
                <?php searchResults(); ?>
            </div>
            <a href="#" role="button" class="l-search-modal__close js-search-close" aria-label="<?= $app->getText('Close search') ?>"></a>
        </div>
    </div><?php
}
