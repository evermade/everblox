<?php
namespace Evermade\Blocks;

class Accordion extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(35);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_'.$blockName,
            'name' => $blockName,
            'label' => 'Accordion',
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
                    'message' => 'The accordion block let\'s you add content that\'s hidden initially, but can be made visible by clicking the title.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_'.$blockName.'_items',
                    'label' => 'Items',
                    'name' => 'items',
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
                    'max' => false,
                    'layout' => 'block',
                    'button_label' => 'Add Item',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_' . $blockName . '_items_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
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
                            'key' => 'field_'.$blockName.'_items_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0,
                        ),
                    ),
                ),
            ),
        ];
    }
}
