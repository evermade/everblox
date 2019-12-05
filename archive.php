<?php
namespace Evermade;

get_header(); ?>

<div class="style style--white-dark">
    <div class="l-archive">
        <div class="l-archive__container">
            <div class="l-archive__title">
                <?php the_archive_title('<h1>', '</h1>'); ?>
            </div>
            <div class="l-archive__items">
                <?php while (have_posts()) { the_post(); ?>
                    <div class="l-archive__item">
                        <?php
                        $itemPostType = get_post_type($post->ID);
                        $template =  "\\Evermade\\Templates\\" . $itemPostType . "Item";

                        if (!function_exists($template)) {
                            $template = "\\Evermade\\Templates\storyItem";
                        }

                        echo $template($post); ?>
                    </div><?php
                } ?>
            </div>
            <div class="l-archive__pagination" data-style-color>
                <?= paginate_links(['type' => 'list', 'prev_next' => false]) ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
