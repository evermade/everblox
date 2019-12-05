<?php
/**
 * This template requires an "id" and "content" values to function properly.
 *
 * Example
 *   $data = [
 *     "content" => "<h1>Lorem ipsum dolor sit amet</h1>",
 *     "id" => "1"
 *   ];
 */

namespace Evermade\Templates;

function inlineModal($data = []) {
    $data = params([
        'id' => '',
        'content' => ''
    ], $data);

    if ($data['id'] === '' || $data['content'] === '') {
        return false;
    } ?>

    <div class="c-modal c-modal--inline micromodal-slide" id="modal-<?= $data['id'] ?>" aria-hidden="true">
        <div class="c-modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="c-modal__container" role="dialog" aria-modal="true">
                <div class="wysiwyg">
                    <?= $data['content'] ?>
                </div>

                <button class="c-modal__close" aria-label="Close modal" data-micromodal-close></button>
            </div>
        </div>
    </div><?php
}

