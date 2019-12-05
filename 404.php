<?php
namespace Evermade;

\get_header();

global $app; ?>

<div class="style style--white-dark">
    <div class="l-visual-editor">
        <div class="l-visual-editor__container wysiwyg" data-style-color>
            <?= $app->getOption("opt_404_content") ?>
        </div>
    </div>
</div>

<?php \get_footer();
