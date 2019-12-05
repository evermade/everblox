<?php
namespace Evermade\Templates;

function summaryCarousel($data = []) {
    $data = params([
        'header' => '',
        'items' => [],
        'customTemplate' => "\\Evermade\\Templates\\customCard",
        'defaultTemplate' => "\\Evermade\\Templates\\storyCard"
    ], $data);

    $itemTypes = \Evermade\Helpers\getUniquePostTypes($data['items']);

    $componentClass = className(
        "l-summary-carousel",
        count($itemTypes) === 1 ? "l-summary-carousel--" . $itemTypes[0] : "l-summary-carousel--mixed",
        $data['header'] ? "l-summary-carousel--has-header" : "l-summary-carousel--no-header",
        "js-summary-carousel"
    ); ?>

    <div <?= $componentClass ?>>
        <div class="l-summary-carousel__container">
            <?php if ($data['header']) : ?>
                <div class="l-summary-carousel__header wysiwyg" data-style-color>
                    <?= $data['header'] ?>
                </div>
            <?php endif; ?>

            <div class="l-summary-carousel__wrapper">
                <div class="l-summary-carousel__items js-summary-carousel-items">
                    <?php if ($data['header']) : ?>
                        <div class="l-summary-carousel__item"></div>
                    <?php endif; ?>

                    <?php foreach ($data['items'] as $item) :

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

                        <div class="l-summary-carousel__item">
                            <?php $template($item) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
}
