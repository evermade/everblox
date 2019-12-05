<?php
namespace Evermade;

use \Evermade\Templates;

global $app;

\get_header(); ?>

<div class="style style--white-dark">
    <div class="l-single">
        <div class="l-single__container">
            <div class="l-single__article" data-style-color>
                <?php while (have_posts()) { the_post();
                    echo Templates\storySingle($post);
                } ?>
            </div>
            <div class="l-single__related">
                <?= Templates\relatedItems(['post' => $post, 'numberOfItems' => 3, 'title' => __('Read next', 'everblox')]) ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
