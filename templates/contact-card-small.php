<?php
namespace Evermade\Templates;

use Evermade\Media;

function contactCardSmall($data = []) {
    global $post;

    $post = $data;

    setup_postdata($data);

    $photo = \get_field('photo');
    $jobTitle = \get_field('job_title');
    $email = \get_field('email');
    $phone = \get_field('phone');
    $socialMediaPresence = \get_field('social_media_presence');
    $fallbackPhoto = \get_field('opt_contact_fallback_photo', 'options'); ?>

    <div class="c-contact-card-small" data-style-color>
        <?php if ($photo) {
            echo Media\image($photo, ['class' => 'c-contact-card-small__image', 'size' => 'small']);
        } else {
            echo Media\image($fallbackPhoto, ['class' => 'c-contact-card-small__image', 'size' => 'small']);
        } ?>

        <div class="c-contact-card-small__content">
            <div class="c-contact-card-small__title">
                <h3 class="c-contact-card-small__name"><?= get_the_title() ?></h3>
                <?php if ($jobTitle) : ?>
                    <p class="c-contact-card-small__job-title"><?= $jobTitle ?></p>
                <?php endif; ?>
            </div>

            <?php if ($email || $phone) : ?>
                <div class="c-contact-card-small__contact">
                    <?php if ($email) : ?>
                        <p class="c-contact-card-small__email"><?= email($email, "inherit-color") ?></p>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                        <p class="c-contact-card-small__phone"><?= $phone ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($socialMediaPresence)) : ?>
                <div class="c-contact-card-small__social">
                    <?php socialMediaLinks(['links' => $socialMediaPresence]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div><?php

    wp_reset_postdata();
}
