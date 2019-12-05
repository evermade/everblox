<?php
namespace Evermade\Blocks;

class Style extends \Evermade\Block {
    public function __construct() {
        parent::__construct();

        $this->setOrder(0);
    }

    public function getFlexibleContentLayout() {

        $blockName = $this->getBlockName();

        // Add your color scheme identifiers to this array
        $colorSchemes = [
            'white-dark',
            'lightGray-dark',
            'brand-light'
        ];

        $colorSchemeChoices = [];
        $colorSchemeMarkup = "<div data-style-color><h3>This is an example of the headings</h3><p>This is an example of paragraph text. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem.</p></div>";

        foreach ($colorSchemes as $k => $choice) {
            $colorSchemeChoices[$choice] = '<div class="style style--' . $choice . '">' . $colorSchemeMarkup . '</div>';
        }

        return [
            'key' => 'group_' . $blockName,
            'name' => $blockName,
            'label' => 'Style',
            'display' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $blockName . '_instructions',
                    'label' => 'How does the Style-block work?',
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
                    'message' => 'The settings you choose here will affect all the following blocks until the end of the page or until the next Style block. All pages have a default Style set to them, so it\'s not necessary to add this block to each page.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_color_scheme',
                    'label' => 'Color Scheme',
                    'name' => 'color_scheme',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => 'style-color-selector',
                        'id' => '',
                    ),
                    'choices' => $colorSchemeChoices,
                    'allow_null' => 0,
                    'default_value' => '',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
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
                        'class' => 'message-warning hide-label',
                        'id' => '',
                    ),
                    'message' => 'The following Style block background image settings are considered <strong>advanced features.</strong> You should always consult the designer of the website before adding brand new Style background images.',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
                array(
                    'key' => 'field_' . $blockName . '_background_image',
                    'label' => 'Background Image',
                    'name' => 'background_image',
                    'type' => 'image',
                    'instructions' => 'Please note that The background image will be cropped in some resolutions.',
                    'required' => 0,
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
                    'key' => 'field_' . $blockName . '_background_image_behavior',
                    'label' => 'Background Image Behavior',
                    'name' => 'background_image_behavior',
                    'type' => 'radio',
                    'instructions' => 'Choose how you want the image to behave.<br>The default <strong>Cover</strong> option is recommended for most images. The <strong>Pattern</strong> option is only recommended for small repeating images.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => 'style-background-image-behavior',
                        'id' => '',
                    ),
                    'choices' => array(
                        'cover' => '<div class="cover"><span>Cover</span></div>',
                        'pattern' => '<div class="pattern"><span>Pattern</span></div>'
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => 'cover',
                    'layout' => 'vertical',
                    'return_format' => 'value',
                ),
            ),
        ];
    }
}
