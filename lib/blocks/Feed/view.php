<?php
namespace Evermade\Blocks\Feed;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'items_per_page' => 12,
    ], $data); ?>

    <section class="l-feed collapse">
        <div class="l-feed__container">
            <div id="feed-app" data-per-page="<?= $data['items_per_page'] ?>">
                <div class="c-spinner"></div>
            </div>
        </div>
    </section>
    <?php
}

