<?php
namespace Evermade\Templates;

function searchResults($data = []) { ?>
    <div class="l-search-results js-search-results">
        <div class="l-search-results__loader">
            <?php spinner(); ?>
        </div>
        <div class="l-search-results__items js-search-items"></div>
    </div><?php
}
