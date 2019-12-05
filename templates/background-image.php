<?php
namespace Evermade\Templates;

use Evermade\Media;

function backgroundImage($data = []) {
    $data = params([
        'image' => '',
        'size' => 'medium'
    ], $data);

    if (!$data['image']) {
        return false;
    }

    $image = Media\getImageData($data['image'], $data['size']);

    $componentStyle = style(
        "background-image: url($image[src])"
    ); ?>

    <div class="c-background-image" role="img" <?= ariaLabel($image['alt']) ?> <?= $componentStyle ?>></div>
<?php
}
