<?php
namespace Evermade\Blocks;

class Summary extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(25);
    }

    public function getFlexibleContentLayout() {
        $blockName = $this->getBlockName();

        /**
         * If you have new post types in the project that you want to make
         * available in the Summary block, first add into this array the
         * post type name as key and other information as the value.
         */

        $postTypes = [
            'story' => [
                'label' => 'Stories',
                'icon' => 'dashicons-format-aside'
            ],
            'contact' => [
                'label' => 'Contacts',
                'icon' => 'dashicons-groups'
            ]
        ];

        // Add slugs of content types that support categories
        $categorySupport = $this->getTaxonomyConditional([
            'story'
        ]);

        // Add slugs of content types that support tags
        $tagSupport = $this->getTaxonomyConditional([
            'story'
        ]);

        $contentChoices = $this->getContentChoices($postTypes);
        $relationshipPostTypes = array_keys($postTypes);

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Summary',
            'display' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $blockName . '_instructions',
                    'label' => 'How does the Summary-block work?',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-info',
                        'id' => '',
                    ),
                    'message' => 'The Summary block lets you display teasers of various content using several different layouts. <br>The block also includes a text field which lets you add a short introductory text before the content items are shown. You can find it in the <strong>Header</strong> tab.',
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
                    'key' => 'field_' . $blockName . '_layout',
                    'label' => 'Layout',
                    'name' => 'layout',
                    'type' => 'radio',
                    'instructions' => 'Choose how you want to lay-out the content.<br>Feel free to experiment with the different layouts, or ask the project\'s designer for assistance.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-selector summary-layout-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'grid' => '<div class="grid"><span>Grid</span></div>',
                        'carousel' => '<div class="carousel"><span>Carousel</span></div>',
                        'list' => '<div class="list"><span>List</span></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'grid',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_display',
                    'label' => 'Display',
                    'name' => 'display',
                    'type' => 'radio',
                    'instructions' => 'Choose how should we decide which items to display.<br>You can either choose to automatically list the latest items or choose specific items manually.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_content',
                                'operator' => '!=',
                                'value' => 'custom',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-selector summary-display-selector',
                        'id' => '',
                    ),
                    'choices' => array(
                        'automatic' => '<div class="automatic"><span>Automatic</span></div>',
                        'manual' => '<div class="manual"><span>Manual</span></div>',
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'automatic',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_content',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'checkbox',
                    'instructions' => 'Choose what type of content you want to show in the block.',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'automatic',
                            )
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-selector summary-content-selector',
                        'id' => '',
                    ),
                    'choices' => $contentChoices,
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'story',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_info-filters',
                    'label' => 'Filters',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_content',
                                'operator' => '!=',
                                'value' => 'custom',
                            ),
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'automatic',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-info hide-label',
                        'id' => '',
                    ),
                    'message' => 'You can use the following settings to filter or change the maximum number of the items showed.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_number_of_items',
                    'label' => 'Number of items',
                    'name' => 'number_of_items',
                    'type' => 'number',
                    'instructions' => 'Choose the maximum number of items to show.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'automatic',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-filter',
                        'id' => '',
                    ),
                    'default_value' => 12,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_' . $blockName . '_categories',
                    'label' => 'Categories',
                    'name' => 'categories',
                    'type' => 'taxonomy',
                    'instructions' => 'You can limit the items to one or more categories.',
                    'required' => 0,
                    'conditional_logic' => $categorySupport,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-filter',
                        'id' => '',
                    ),
                    'taxonomy' => 'category',
                    'field_type' => 'checkbox',
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                    'allow_null' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_tags',
                    'label' => 'Tags',
                    'name' => 'tags',
                    'type' => 'taxonomy',
                    'instructions' => 'You can limit the items to one or more tags.',
                    'required' => 0,
                    'conditional_logic' => $tagSupport,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'summary-filter',
                        'id' => '',
                    ),
                    'taxonomy' => 'post_tag',
                    'field_type' => 'multi_select',
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                    'allow_null' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_manual_items_instructions',
                    'label' => 'How to select Summary items manually?',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'manual',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-info',
                        'id' => '',
                    ),
                    'message' => 'You have two ways of adding Summary items manually – you can either handpick existing items in the field below, or create completely custom items in the field below that. You can freely combine the two as you wish.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_manual_items',
                    'label' => 'Choose Items',
                    'name' => 'manual_items',
                    'type' => 'relationship',
                    'instructions' => 'Choose which items you want to display by dragging them to the right column.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'manual',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => $relationshipPostTypes,
                    'taxonomy' => '',
                    'filters' => array(
                        0 => 'search',
                        1 => 'post_type'
                    ),
                    'elements' => '',
                    'min' => 0,
                    'max' => '',
                    'return_format' => 'object',
                ),
                array(
                    'key' => 'field_' . $blockName . '_custom_items',
                    'label' => 'Create Custom Items',
                    'name' => 'custom_items',
                    'type' => 'repeater',
                    'instructions' => 'Create completely custom items unique to this block.',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_display',
                                'operator' => '==',
                                'value' => 'manual',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 12,
                    'layout' => 'table',
                    'button_label' => 'Add Item',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_' . $blockName . '_custom_items_image',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
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
                            'key' => 'field_' . $blockName . '_custom_items_title',
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
                            'key' => 'field_' . $blockName . '_custom_items_text',
                            'label' => 'Text',
                            'name' => 'text',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
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
                            'key' => 'field_' . $blockName . '_custom_items_link',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'link',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_' . $blockName . '_tab_header',
                    'label' => 'Header',
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
                    'key' => 'field_' . $blockName . '_header_warning',
                    'label' => 'Warning',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $blockName . '_layout',
                                'operator' => '==',
                                'value' => 'carousel',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'message-danger hide-label',
                        'id' => '',
                    ),
                    'message' => 'Please note that the <strong>Carousel</strong> layout has very limited space for the header. <br>In case you are unsure if your header is too long, ask the project\'s developer or designer for assistance.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_header',
                    'label' => 'Header',
                    'name' => 'header',
                    'type' => 'wysiwyg',
                    'instructions' => 'You can add an optional introductory text here, which will be displayed next to the content. The positioning depends on the layout selected.<br>A good introduction has a short headline, one paragraph of text and optionally a link to find more content.',
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
                    'media_upload' => 0,
                    'delay' => 0,
                )
            ),
        ];
    }

    private function getContentChoices($data = [])
    {
        $arr = [];

        foreach ($data as $k => $contentType) {
            $arr[$k] = '<div><span class="icon dashicons ' . $contentType['icon'] . '"></span><span class="text">' . $contentType['label'] . '</span></div>';
        }

        return $arr;
    }

    private function getTaxonomyConditional($data = [])
    {
        $blockName = $this->getBlockName();

        $arr = [];

        foreach ($data as $k => $contentType) {
            $arr[] = [
                [
                    'field' => 'field_' . $blockName . '_display',
                    'operator' => '==',
                    'value' => 'automatic',
                ],
                [
                    'field' => 'field_' . $blockName . '_content',
                    'operator' => '==',
                    'value' => $contentType
                ]
            ];
        }

        return $arr;
    }
}