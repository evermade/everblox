<?php
namespace Evermade\Templates;

function summaryList($data = []) {
    $data = params([
        'header' => '',
        'items' => [],
        'customTemplate' => "\\Evermade\\Templates\\customCardSmall",
        'defaultTemplate' => "\\Evermade\\Templates\\storyCardSmall"
    ], $data);

    $itemTypes = \Evermade\Helpers\getUniquePostTypes($data['items']);

    $componentClass = className(
        "l-summary-list",
        count($itemTypes) === 1 ? "l-summary-list--" . $itemTypes[0] : "l-summary-list--mixed"
    ); ?>

    <div <?= $componentClass ?>>
        <div class="l-summary-list__container">
            <?php if ($data['header'] !== '') : ?>
                <div class="l-summary-list__header wysiwyg" data-style-color>
                    <?= $data['header'] ?>
                </div>
            <?php endif; ?>

            <div class="l-summary-list__items">
                <?php foreach ($data['items'] as $item) :

                    /**
                     * Get the appropriate component template, either the
                     * custom template, current post type template or finally
                     * the default template.
                     */
                    $template = is_array($item)
                        ? $data['customTemplate']
                        : "\\Evermade\\Templates\\" . get_post_type($item) . "CardSmall";

                    if (!function_exists($template)) {
                        $template = $data['defaultTemplate'];
                    } ?>

                    <div class="l-summary-list__item">
                        <?php $template($item) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><?php
}
