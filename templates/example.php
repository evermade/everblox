<?php

namespace Evermade\Templates;

use Evermade\Media;

function example($data = []) {
    global $app;

    $data = params([
        'lang' => $app->getLanguage(),
        'image' => get_the_post_thumbnail(),
    ], $data);

    if (!$data['lang']) {
        return false;
    } ?>

    <div class="c-example">
        <?php if ($data['image']) : ?>
            <div class="c-example__image">
              <?php echo Media\image($data['image']); ?>
            </div>
        <?php endif; ?>

        <h2><?=title('the_title filter has been applied to me')?></h2>

        <span><?= $app->getText('Example translation') ?></span>

        <p class="c-example__lang"><?= $data['lang'] ?></p>
    </div><?php
}
