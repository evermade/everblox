<?php
namespace Evermade\Blocks;

class VisualEditor extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(5);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        return [
            'key' => 'group_'.$blockName,
            'name' => $blockName,
            'label' => 'Visual Editor',
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
                    'message' => 'You can add one to four visual editors that will be displayed side by side in columns. You can also use the Visual Editor block to act as a header element for following blocks.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_'.$blockName.'_tab_content',
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
                    'key' => 'field_'.$blockName.'_columns',
                    'label' => 'Columns',
                    'name' => 'columns',
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
                    'max' => 4,
                    'layout' => 'block',
                    'button_label' => 'Add Column',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_'.$blockName.'_columns_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '75',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0,
                        ),
                        array(
                            'key' => 'field_' . $blockName . '_columns_style',
                            'label' => 'Style',
                            'name' => 'style',
                            'type' => 'radio',
                            'instructions' => 'By default the column gets it\'s visuals from the page styles or a Style block. You can make the column appear inside a specially styled box instead, ignoring parent styles. Ask the project\'s designer or developer for assitance if you\'re unsure what to do.',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '25',
                                'class' => 'visual-editor-style-selector',
                                'id' => '',
                            ),
                            'choices' => array(
                                'none' => '<div class="none"><span>None</span></div>',
                                'box' => '<div class="box"><span>Box</span></div>'
                            ),
                            'allow_null' => 0,
                            'other_choice' => 0,
                            'save_other_choice' => 0,
                            'default_value' => 'none',
                            'layout' => 'horizontal',
                            'return_format' => 'value',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_'.$blockName.'_tab_settings',
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
                    'key' => 'field_'.$blockName.'_spacing',
                    'label' => 'Spacing Between Next Block',
                    'name' => 'spacing',
                    'type' => 'radio',
                    'instructions' => 'With the spacing selector you can make this Visual Editor act as a headline to the following block.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector visual-editor-spacing-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'block' => '<div><span style="height: 38px;"></span><span style="height: 24px; opacity: 0.3;"></span><span style="height: 38px;"></span></div>',
                        'headline' => '<div><span style="height: 8px; opacity: 0;"></span><span style="height: 38px;"></span><span style="height: 8px; opacity: 0.3;"></span><span style="height: 38px;"></span><span style="height: 8px; opacity: 0;"></span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'block',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_' . $blockName . '_layout_instructions',
                    'label' => 'Instructions',
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
                    'message' => 'Please note that the following layout options are shown based on the number of columns you have in use on the <strong>Content</strong> tab.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_'.$blockName.'_one_column_layout',
                    'label' => 'One Column Layout',
                    'name' => 'one_column_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose the layout of a single column.<br>This setting affects the width and alignment of the column.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '>',
                            'value' => '0',
                        ),
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '<',
                            'value' => '2',
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector visual-editor-layout-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'narrow-left' => '<div><span style="width: 50%;"></span> <span style="width: 50%; opacity: 0.3;"></span></div>',
                        'full-width' => '<div><span style="width: 100%;"></span></div>',
                        'narrow-center' => '<div><span style="width: 25%; opacity: 0.3;"></span> <span style="width: 50%;"></span> <span style="width: 25%; opacity: 0.3;"></span></div>',
                        'narrow-right' => '<div><span style="width: 50%; opacity: 0.3;"></span> <span style="width: 50%;"></span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'narrow-left',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_'.$blockName.'_two_column_layout',
                    'label' => 'Two Column Layout',
                    'name' => 'two_column_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose the division of the columns for two-column blocks.<br>By default the columns are separated evenly 50/50.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '>',
                            'value' => '1',
                        ),
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '<',
                            'value' => '3',
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector visual-editor-layout-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        '50-50' => '<div><span style="width: 50%;"></span> <span style="width: 50%;"></span></div>',
                        '33-66' => '<div><span style="width: 33.3333%;"></span> <span style="width: 66.6666%;"></span></div>',
                        '66-33' => '<div><span style="width: 66.6666%;"></span> <span style="width: 33.3333%;"></span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '50-50',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_'.$blockName.'_three_column_layout',
                    'label' => 'Three Column Layout',
                    'name' => 'three_column_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose the division of the columns for three-column blocks.<br>By default the columns are separated evenly 33/33/33.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '>',
                            'value' => '2',
                        ),
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '<',
                            'value' => '4',
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector visual-editor-layout-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        '33-33-33' => '<div><span style="width: 33.3333%;"></span> <span style="width: 33.3333%;"></span> <span style="width: 33.3333%;"></span></div>',
                        '50-25-25' => '<div><span style="width: 50%;"></span> <span style="width: 25%;"></span> <span style="width: 25%;"></span></div>',
                        '25-25-50' => '<div><span style="width: 25%;"></span> <span style="width: 25%;"></span> <span style="width: 50%;"></span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '33-33-33',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_'.$blockName.'_four_column_layout',
                    'label' => 'Four Column Layout – Small Screens',
                    'name' => 'four_column_layout',
                    'type' => 'radio',
                    'instructions' => 'Choose how four-column blocks behave on smaller screens.<br>By default the columns are separater into two 50/50 rows on smaller screens.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '>',
                            'value' => '3',
                        ),
                        array(
                            'field' => 'field_'.$blockName.'_columns',
                            'operator' => '<',
                            'value' => '5',
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'horizontal-selector visual-editor-layout-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        '50-50' => '<div><span style="width: 50%;"></span> <span style="width: 50%;"></span> <span style="width: 50%;"></span> <span style="width: 50%;"></span></div>',
                        '25-25-25-25' => '<div class="double-height"><span style="width: 25%;"></span> <span style="width: 25%;"></span> <span style="width: 25%;"></span> <span style="width: 25%;"></span></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '50-50',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
            ),
        ];
    }
}
