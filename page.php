<?php
namespace Evermade;

get_header();

global $app; ?>

<div class="style style--white-dark">
    <?php
    if (post_password_required()) {
        \Evermade\Templates\passwordForm();
    } else {
        $app->printPagebuilder();
    } ?>
</div>

<?php get_footer();
