<?php
namespace Evermade\Templates;

use Evermade\Media;

function socialMediaLinks($data = []) {
    global $app;

    $data = params([
        'links' => [],
        'class' => ''
    ], $data);

    if (!$data['links']) {
        $data['links'] = $app->getOption('opt_social_media');
    }

    if (!$data['links'] || empty($data['links'])) {
        return false;
    }

    $componentClass = className(
        "c-social-media-links",
        $data['class']
    ); ?>

    <div <?= $componentClass ?>>
        <ul class="c-social-media-links__list">
            <?php foreach ($data['links'] as $socialMedia) : ?>
                <li>
                    <a href="<?= $socialMedia['url'] ?>" <?= ariaLabel($app->getText('Visit us on') . " $socialMedia[service]") ?>>
                        <?= Media\svg("icon-{$socialMedia['service']}.svg") ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div><?php
}
