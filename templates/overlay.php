<?php
namespace Evermade\Templates;

function overlay($data = []) {
    $data = params([
        'opacity' => '0.5',
    ], $data);

    $componentStyle = style(
        "opacity: $data[opacity]"
    ); ?>

    <div class="c-overlay" <?= $componentStyle ?>></div><?php
}
