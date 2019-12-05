<?php
namespace Evermade\Templates;

function headlineTextButtons($data = []) {
    $data = params([
        'headline' => '',
        'text' => '',
        'buttons' => [],
        'button_color' => 'dark'
    ], $data);

    if (!$data['headline']) {
        return false;
    } ?>

    <div class="c-headline-text-buttons">
        <h1 class="c-headline-text-buttons__headline animated fadeInUp"><?= $data['headline'] ?></h1>

        <?php if ($data['text']) : ?>
            <div class="c-headline-text-buttons__text wysiwyg animated fadeInUp delay--1">
                <?= $data['text'] ?>
            </div>
        <?php endif; ?>

        <?php if ($data['buttons']) : ?>
            <div class="c-headline-text-buttons__buttons">
                <?php foreach ($data['buttons'] as $k => $button) : ?>
                    <div class="c-headline-text-buttons__button animated fadeInLeft delay--<?= 2 + $k ?>">
                        <?php if ($button['style'] === 'text-button') {
                            $button['text_&_link']['ariaLabel'] = $button['aria_label'];
                            $button['text_&_link']['class'] = "c-text-button--color-$data[button_color]";

                            textButton($button['text_&_link']);
                        } else {
                            $button['text_&_link']['ariaLabel'] = $button['aria_label'];
                            $button['text_&_link']['class'] = implode(' ', [
                                $button['style'] === 'secondary' ? "c-button--secondary" : "",
                                "c-button--color-$data[button_color]"
                            ]);

                            button($button['text_&_link']);
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
