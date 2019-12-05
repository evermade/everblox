<?php
namespace Evermade;

use Evermade\Templates;
use Evermade\Media;

global $app; ?>

        </div><?php //  end of .l-site-content ?>

        <footer class="l-footer">
            <div class="l-footer__container">
                <div class="l-footer__columns">
                    <div class="l-footer__logo">
                        <a href="<?= get_bloginfo('url') ?>" title="<?= get_bloginfo('name') ?>">
                            <img src="<?= $app->themeDir.'/assets/img/logo-dark.png' ?>" alt="<?= get_bloginfo('name') ?>" />
                        </a>
                    </div>

                    <div class="l-footer__menu">
                        <?php wp_nav_menu(array('theme_location' => 'footer-navigation', 'menu_class' => 'c-footer-menu', 'container' => '', 'fallback_cb' => false)); ?>
                    </div>

                    <div class="l-footer__social-media">
                        <?php Templates\socialMediaLinks(); ?>
                    </div>
                </div>
            </div>

            <div class="l-footer__container">
                <div class="l-footer__bottom">
                    <div class="l-footer__bottom-primary">
                        <?= $app->getOption('opt_footer_bottom_primary_text') ?>
                    </div>
                    <div class="l-footer__bottom-secondary">
                        <?= $app->getOption('opt_footer_bottom_secondary_text') ?>
                    </div>
                </div>
            </div>
        </footer>

        <?php Templates\searchModal(); ?>

        <?php wp_footer(); ?>

    </body>
</html>
