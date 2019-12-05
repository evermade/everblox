<?php
namespace Evermade\Blocks;

class ImageGallery extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(20);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Image Gallery',
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
                    'message' => 'In most cases it\'s recommended to use JPG images <strong>only</strong>. Please note that especially if you add a lot of images to the carousel, the page can get quite heavy. If you just want to bring a single image on a page, you can also use the <strong>Visual Editor</strong> block, using a full width single column layout.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_images',
                    'label' => 'Images',
                    'name' => 'images',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 1,
                    'max' => 12,
                    'layout' => 'block',
                    'button_label' => 'Add Image',
                    'sub_fields' => array(
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
                            'key' => 'field_' . $blockName . '_caption',
                            'label' => 'Caption',
                            'name' => 'caption',
                            'type' => 'textarea',
                            'instructions' => 'Please note that this block <strong>does not</strong> use the caption setting of individual images. The caption is shown below the image in the carousel.',
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
                            'rows' => 4,
                            'new_lines' => '',
                        ),
                    ),
                ),
            ),
        ];
    }
}
