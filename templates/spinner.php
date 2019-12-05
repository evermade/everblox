<?php
namespace Evermade\Templates;

function spinner($data = []) {
    $data = params([
        'color' => 'dark',
    ], $data);

    $componentClass = className(
        'c-spinner',
        'c-spinner--color-'.$data['color']
    ); ?>

    <div <?= $componentClass ?>></div><?php
}
