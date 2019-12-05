<?php
namespace Evermade\Templates;

function passwordForm($data = []) { ?>
    <div class="l-visual-editor">
        <div class="l-visual-editor__container">
            <div class="l-visual-editor__items" data-columns="1" data-one-layout="narrow-center">
                <div class="l-visual-editor__item wysiwyg">
                    <?= get_the_password_form() ?>
                </div>
            </div>
        </div>
    </div><?php
}
