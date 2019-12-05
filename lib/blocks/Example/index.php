<?php
namespace Evermade\Blocks;

class Example extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(5);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Example',
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
                    'message' => 'This is an example description of how this block works. Even if your block doesn\'t have any other fields, it\'s always recommended to have a short explanation of what the block does.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
            ),
        ];
    }
}
