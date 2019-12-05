<?php
namespace Evermade\Templates;

function summaryGrid($data = []) {
    $data = params([
        'header' => '',
        'items' => [],
        'customTemplate' => "\\Evermade\\Templates\\customCard",
        'defaultTemplate' => "\\Evermade\\Templates\\storyCard",
    ], $data);

    $itemTypes = \Evermade\Helpers\getUniquePostTypes($data['items']);

    $componentClass = className(
        "l-summary-grid",
        count($itemTypes) === 1 ? "l-summary-grid--" . $itemTypes[0] : "l-summary-grid--mixed"
    ); ?>

    <div <?= $componentClass ?>>
        <div class="l-summary-grid__container">
            <?php if ($data['header']) : ?>
                <div class="l-summary-grid__header wysiwyg" data-style-color>
                    <?= $data['header'] ?>
                </div>
            <?php endif; ?>

            <div class="l-summary-grid__items">
                <?php foreach ($data['items'] as $k => $item) :

                    /**
                     * Get the appropriate component template, either the
                     * custom template, current post type template or finally
                     * the default template.
                     */
                    $template = is_array($item)
                        ? $data['customTemplate']
                        : "\\Evermade\\Templates\\" . get_post_type($item) . "Card";

                    if (!function_exists($template)) {
                        $template = $data['defaultTemplate'];
                    } ?>

                    <div class="l-summary-grid__item" data-animate="animated fadeInUp delay--<?= $k % 3 ?>">
                        <?php $template($item) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><?php
}
