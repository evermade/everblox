<?php
namespace Evermade\Blocks\Accordion;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'items' => [],
    ], $data);

    if (!sizeof($data['items'])) {
        return false;
    } ?>

    <section class="l-accordion collapse" data-style-color>
        <div class="l-accordion__container">
            <div class="l-accordion__items">
                <?php foreach ($data['items'] as $key => $item) : ?>
                    <div class="l-accordion__item">
                        <?php Templates\accordionItem(['title' => $item['title'], 'content' => $item['content']]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
}
