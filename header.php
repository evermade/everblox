<?php
namespace Evermade;

use Evermade\Templates;

global $app;

/**
 * The ASCII art is disabled by default. Before enabling, please make sure
 * we've done both the design and development in the project.
 *
 * If the site was designed by an outside agency, be sure to ask permission
 * before enabling the ASCII.
 */

if ($app->asciiEnabled) { ?>
<!--

    ≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡
     _________    _____
    |_________|  |  ___|                                   _
     _________   | |_  __   _____ _ __ _ __ ___   __ _  __| | ___
    |_________|  |  _| \ \ / / _ \ '__| '_ ` _ \ / _` |/ _` |/ _ \
     _________   | |___ \ V /  __/ |  | | | | | | (_| | (_| |  __/
    |_________|  |_____| \_/ \___|_|  |_| |_| |_|\__,_|\__,_|\___|

                ≡ Evermade.fi - Design & Development

    ≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡≡

--><?php
} ?>
<!doctype html>
<html lang="<?= $app->getLanguage() ?>" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <script>
    if (window.jQuery) {
        if(!window.$) $ = jQuery;
    }
    </script>
</head>
<body <?php body_class(); ?>>

<a href="#site-content" class="c-skip-to-content"><?php _e('Skip to content', 'everblox'); ?></a>

<header class="l-header js-header">
    <div class="l-header__bar">
        <div class="l-header__container">

            <div class="l-navigation-bar">
                <div class="l-navigation-bar__logo">
                    <?php Templates\headerLogo(); ?>
                </div>
                <div class="l-navigation-bar__menu">
                    <nav>
                        <?php wp_nav_menu(array('container_class' => 'c-header-menu-desktop', 'menu_class' => 'c-header-menu-desktop__list', 'theme_location' => 'header-navigation', 'fallback_cb' => false)); ?>
                    </nav>
                </div>
                <div class="l-navigation-bar__tools">
                    <div class="l-navigation-bar__search-toggle">
                        <?php Templates\searchToggle(); ?>
                    </div>
                    <div class="l-navigation-bar__menu-toggle">
                        <?php Templates\menuToggle(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="l-header__mobile-navigation">

        <div class="l-mobile-navigation">
            <div class="l-mobile-navigation__menu">
                <?php wp_nav_menu(array('container_class' => 'c-header-menu-mobile', 'menu_class' => 'c-header-menu-mobile__list', 'theme_location' => 'header-navigation', 'fallback_cb' => false)); ?>
            </div>
            <div class="l-mobile-navigation__tools">
                <div class="l-mobile-navigation__social">
                    <?php Templates\socialMediaLinks(); ?>
                </div>
            </div>
        </div>

    </div>
</header>

<div id="site-content" class="l-site-content" tabindex="-1">
