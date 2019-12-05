<?php
namespace Evermade\Templates;

use Evermade\Media;

function contactCard($data = []) {
    global $post;

    $post = $data;

    setup_postdata($data);

    $photo = \get_field('photo');
    $jobTitle = \get_field('job_title');
    $email = \get_field('email');
    $phone = \get_field('phone');
    $socialMediaPresence = \get_field('social_media_presence');
    $fallbackPhoto = \get_field('opt_contact_fallback_photo', 'options'); ?>

    <div class="c-contact-card" data-style-color>
        <?php if ($photo) {
            echo Media\image($photo, ['class' => 'c-contact-card__image', 'size' => 'small']);
        } else {
            echo Media\image($fallbackPhoto, ['class' => 'c-contact-card__image', 'size' => 'small']);
        } ?>

        <div class="c-contact-card__content">
            <div class="c-contact-card__title">
                <h3 class="c-contact-card__name"><?= get_the_title() ?></h3>
                <?php if ($jobTitle) : ?>
                    <p class="c-contact-card__job-title"><?= $jobTitle ?></p>
                <?php endif; ?>
            </div>

            <?php if ($email || $phone) : ?>
                <div class="c-contact-card__contact">
                    <?php if ($email) : ?>
                        <p class="c-contact-card__email"><?= email($email, "inherit-color") ?></p>
                    <?php endif; ?>
                    <?php if ($phone) : ?>
                        <p class="c-contact-card__phone"><?= $phone ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($socialMediaPresence)) : ?>
                <div class="c-contact-card__social">
                    <?php socialMediaLinks(['links' => $socialMediaPresence]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div><?php

    wp_reset_postdata();
}
