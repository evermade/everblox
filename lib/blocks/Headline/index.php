<?php
namespace Evermade\Blocks;

class Headline extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(15);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Headline',
            'display' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $blockName . '_instructions',
                    'label' => 'Instructions',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-info hide-label',
                        'id' => '',
                    ),
                    'message' => 'It\'s generally recommended to only use this block as the first block on page.<br>See the <strong>Media</strong> tab for the image and video options.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_tab_content',
                    'label' => 'Content',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_headline',
                    'label' => 'Headline',
                    'name' => 'headline',
                    'type' => 'text',
                    'instructions' => 'You should keep the headline relatively short and to the point.',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_' . $blockName . '_text',
                    'label' => 'Text',
                    'name' => 'text',
                    'type' => 'textarea',
                    'instructions' => 'Optional, it\'s recommended to only add one paragraph of text.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_' . $blockName . '_buttons',
                    'label' => 'Buttons',
                    'name' => 'buttons',
                    'type' => 'repeater',
                    'instructions' => 'You can optionally add up to two button links, however It\'s recommended to only have one CTA per headline block.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 2,
                    'layout' => 'table',
                    'button_label' => 'Add Button',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_' . $blockName . '_button_style',
                            'label' => 'Style',
                            'name' => 'style',
                            'type' => 'radio',
                            'instructions' => 'This selection affects the appearance of the button. Generally it\'s recommended to use a Primary style for single buttons and a Primary / Secondary combo for two buttons. Ask the project\'s designer for assistance if you\'re unsure what styles to use.',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '33',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'primary' => 'Primary',
                                'secondary' => 'Secondary',
                                'text-button' => 'Text Button',
                            ),
                            'allow_null' => 0,
                            'other_choice' => 0,
                            'default_value' => '',
                            'layout' => 'vertical',
                            'return_format' => 'value',
                            'save_other_choice' => 0,
                        ),
                        array(
                            'key' => 'field_' . $blockName . '_button_text_&_link',
                            'label' => 'Text & Link',
                            'name' => 'text_&_link',
                            'type' => 'link',
                            'instructions' => 'By default the button will say "Read more". You can change the text by setting it into the <strong>Link Text</strong> field in the prompt.',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '33',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                        ),
                        array(
                            'key' => 'field_' . $blockName . '_button_aria_label',
                            'label' => 'Aria Label',
                            'name' => 'aria_label',
                            'type' => 'text',
                            'instructions' => 'Additional information for people with accessability features, like screen readers. If you don\'t know what to put here, it\'s best to leave it empty.',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '33',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_' . $blockName . '_tab_media',
                    'label' => 'Media',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_background_image',
                    'label' => 'Background Image',
                    'name' => 'background_image',
                    'type' => 'image',
                    'instructions' => 'Only images in JPG format are allowed (.jpg, .jpeg). Please note that The background image will be cropped in some resolutions.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'align-left headline-background-image',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => 'jpg, jpeg',
                ),
                array(
                    'key' => 'field_' . $blockName . '_background_video',
                    'label' => 'Background Video',
                    'name' => 'background_video',
                    'type' => 'radio',
                    'instructions' => 'You can choose to play a background video in the background of the headline. We support Vimeo and YouTube by default.<br><strong>Only videos in 16:9 aspect ratio supported.</strong>',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'align-right',
                        'id' => '',
                    ),
                    'choices' => array(
                        'none' => 'None',
                        'vimeo' => 'Vimeo',
                        'youtube' => 'YouTube',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => '',
                    'layout' => 'vertical',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_vimeo_video_id',
                    'label' => 'Vimeo Video ID',
                    'name' => 'vimeo_video_id',
                    'type' => 'text',
                    'instructions' => 'You can find the Vimeo video ID from the end of the video URL.<br>If your Vimeo video is not autoplaying, please see the video settings in Vimeo.com and disable all control elements.',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_background_video',
                                'operator' => '==',
                                'value' => 'vimeo',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'align-right',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'e.g. 76979871',
                    'prepend' => 'Video ID',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_' . $blockName . '_youtube_video_id',
                    'label' => 'YouTube Video ID',
                    'name' => 'youtube_video_id',
                    'type' => 'text',
                    'instructions' => 'You can find the YouTube video ID from the end of the video URL.',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_background_video',
                                'operator' => '==',
                                'value' => 'youtube',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'align-right',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'e.g. jNQXAC9IVRw',
                    'prepend' => 'Video ID',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_' . $blockName . '_warning',
                    'label' => 'Warning',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-warning hide-label clear',
                        'id' => '',
                    ),
                    'message' => 'The following illustration field is considered an <strong>advanced feature.</strong> As the image is set on top of the background image, it\'s generally recommended to use a 24-bit PNG image with a transparent background.<br>If you are unsure what kind of image file to add, please consult the designer or developer of this website.<br><br>You can find settings related to the illustration position in the <strong>Settings</strong> tab.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_image',
                    'label' => 'Illustration',
                    'name' => 'image',
                    'type' => 'image',
                    'instructions' => 'The illustration will be placed on top of the background image, next to the content set in the <strong>Content</strong> tab.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'align-center text-center',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => 'jpg, jpeg, png',
                ),
                array(
                    'key' => 'field_' . $blockName . '_tab_settings',
                    'label' => 'Settings',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_vertical_spacing',
                    'label' => 'Block Height',
                    'name' => 'vertical_spacing',
                    'type' => 'radio',
                    'instructions' => 'Choose if you want the block height to be determined by the content or if it\'s scaled to cover the entire viewport.<br>Use the latter to create a more impactful block, for example on the homepage of the website.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector headline-spacing-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'content' => '<div class="content"><span style="height: 50px;"></span><span style="height: 50px; opacity: 0.3;"></span></div>',
                        'viewport' => '<div class="viewport"><span style="height: 100px;"></span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'content',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_' . $blockName . '_overlay_opacity',
                    'label' => 'Darken Background',
                    'name' => 'overlay_opacity',
                    'type' => 'range',
                    'instructions' => 'Most images and/or videos need to be slightly darkened when text is overlaid on them.<br>Depending on the lightness of the image, you may need to adjust this setting manually.<br><br>Higher value means the background will be darker.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'align-center text-center',
                        'id' => '',
                    ),
                    'default_value' => 40,
                    'min' => 0,
                    'max' => 100,
                    'step' => '',
                    'prepend' => '0%',
                    'append' => '100%',
                ),
                array(
                    'key' => 'field_' . $blockName . '_button_color',
                    'label' => 'Button Color',
                    'name' => 'button_color',
                    'type' => 'radio',
                    'instructions' => 'If the buttons are not clearly visible on top of your chosen background, you can change their color with this setting.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector headline-button-color-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'dark' => '<div><div class="c-button c-button--color-dark"><span class="c-button__text">Read more</span></div></div>',
                        'light' => '<div><div class="c-button c-button--color-light"><span class="c-button__text">Read more</span></div></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'dark',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_image_align_warning',
                    'label' => 'Warning',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-warning hide-label',
                        'id' => '',
                    ),
                    'message' => 'The following illustration setting is considered an <strong>advanced feature.</strong> If you are unsure how to use it, please consult the website\'s designer or developer.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_image_align',
                    'label' => 'Illustration Alignment',
                    'name' => 'image_align',
                    'type' => 'radio',
                    'instructions' => 'In most cases it\'s recommended to keep this setting in the default (middle).<br>If you have an illustration that cuts off from the top or from the bottom, it\'s recommended to switch to corresponding align setting.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'headline-image-align-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'top' => '<div class="top"><span>Top</span></div>',
                        'middle' => '<div class="middle"><span>Middle</span></div>',
                        'bottom' => '<div class="bottom"><span>Bottom</span></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'middle',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
            ),
        ];
    }
}
