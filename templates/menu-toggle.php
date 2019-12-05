<?php
namespace Evermade\Templates;

function menuToggle($data = []) {
    global $app;

    $data = params([
        'class' => 'js-header-toggle',
    ], $data);

    $componentClass = className(
        "c-menu-toggle",
        $data['class']
    ); ?>

    <button <?= $componentClass?> role="button" <?= ariaLabel($app->getText('Toggle menu')) ?>>
        <span class="c-menu-toggle__icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </button><?php
}
