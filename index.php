<?php
namespace Evermade;
// this is the fallback template file if no other templates in the hierarchy are found

\get_header();

?>

<div class="style style--white-dark">
    <div class="l-visual-editor">
        <div class="l-visual-editor__container wysiwyg" data-style-color>
            <?php while (\have_posts()) { \the_post(); ?>
                <h1><?php \the_title(); ?></h1>
                <?php \the_content(); ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php \get_footer();
