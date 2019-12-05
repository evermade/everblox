<?php
namespace Evermade\Templates;

function backgroundVideo($data = []) {
    $data = params([
        'type' => 'youtube',
        'id' => ''
    ], $data);

    if (!$data['id']) {
        return false;
    }

    $componentClass = className(
        "c-background-video",
        "c-background-video--$data[type]",
        $data["type"] === "youtube" ? "js-cover" : ""
    ); ?>

    <div <?= $componentClass ?>>
        <?php if ($data['type'] === 'vimeo') : ?>
            <iframe
              title="Vimeo video"
              src="https://player.vimeo.com/video/<?= $data['id'] ?>?background=1&autoplay=1&loop=1&byline=0&title=0&muted=1"
              class="js-cover"
              frameborder="0"
            ></iframe>
        <?php elseif ($data['type'] === 'youtube') : ?>
            <div class="js-youtube-background" data-id="<?= $data['id'] ?>"></div>
        <?php endif; ?>
    </div><?php
}
