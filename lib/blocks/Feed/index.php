<?php
namespace Evermade\Blocks;

class Feed extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(40);

        require_once "rest-api.php";
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Feed',
            'display' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $blockName . '_warning',
                    'label' => 'Warning: This block is an advanced feature.',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-warning',
                        'id' => '',
                    ),
                    'message' => 'The Feed block initiates an application that shows a feed of miscellaneous site content.<strong>Do not add more than one Feed block per page.</strong> Generally it\'s recommended to only have the Feed block in one place throughout the whole website. If you are unsure if you should use this block, consult the developer or designer of the project.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_items_per_page',
                    'label' => 'Number of items per page',
                    'name' => 'items_per_page',
                    'type' => 'number',
                    'instructions' => 'Choose the number of items that are shown per page. This is also the amount of items loaded on each press of the "Show more" button.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 12,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                )
            ),
        ];
    }
}
