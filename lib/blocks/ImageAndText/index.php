<?php
namespace Evermade\Blocks;

class ImageAndText extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(10);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Image and Text',
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
                    'message' => 'Use this block to display an image and text side by side. It\'s recommended to keep the text short – if you have a lot of content, create a short summary and link to a separate page. See the <strong>Settings</strong> tab for layout options.',
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
                    'key' => 'field_' . $blockName . '_layout_instructions',
                    'label' => 'Instructions',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_image_behavior',
                                'operator' => '==',
                                'value' => 'cover',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-warning hide-label',
                        'id' => '',
                    ),
                    'message' => 'Please note that as you\'ve chosen the <strong>Cover</strong> image behavior in the <strong>Settings</strong>, your image will be cropped in some resolutions.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_text',
                    'label' => 'Text',
                    'name' => 'text',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_image',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'instructions' => 'It\'s highly recommended to use a JPG format image.',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
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
                    'mime_types' => '',
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
                    'key' => 'field_' . $blockName . '_side_layout',
                    'label' => 'Layout: Side-by-side',
                    'name' => 'side_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose the layout when the image and text are displayed side by side on large screens.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'image-and-text-selector image-and-text-side',
                        'id' => '',
                    ),
                    'choices' => array(
                        'text-side-left' => '<div class="text-left"></div>',
                        'text-side-right' => '<div class="text-right"></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'text-left',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_' . $blockName . '_stack_layout',
                    'label' => 'Layout: Stacked',
                    'name' => 'stack_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose the layout when the image and text are displayed stacked on smaller screens.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'image-and-text-selector image-and-text-stack',
                        'id' => '',
                    ),
                    'choices' => array(
                        'text-stack-bottom' => '<div class="text-bottom"></div>',
                        'text-stack-top' => '<div class="text-top"></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'text-left',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_' . $blockName . '_image_behavior',
                    'label' => 'Image Behavior',
                    'name' => 'image_behavior',
                    'type' => 'radio',
                    'instructions' => 'Choose how you want the image to behave.<br>The <strong>Contain</strong> option is recommended for most meaningful images. The <strong>Cover</strong> option is only recommended for &quot;mood setting&quot; images.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'image-and-text-selector image-and-text-image-behavior',
                        'id' => '',
                    ),
                    'choices' => array(
                        'contain' => '<div class="contain"><span>Contain</span></div>',
                        'cover' => '<div class="cover"><span>Cover</span></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'contain',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
            ),
        ];
    }
}
