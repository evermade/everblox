<?php
namespace Evermade;

class Application {
    protected static $instance;
    protected $blocks = [];
    protected $multipleLanguages = false;
    protected $defaultPagebuilderName = 'everblox_v1';

    public $appEnvironment = null;
    public $assetManifests = [];
    public $themeDir = null;
    public $asciiEnabled = null;

    /**
     * This can be used to get shit done, but it will be removed in the end of the refactor.
     * Templates are going to be functions so templates don't need to be included, they can just be called.
     * @deprecated
     */
    public $themeDirOnServer = null;

    /**
     * Initialize the application.
     */
    public function __construct(boolean $multipleLanguages = null) {
        $this->appEnvironment = $_ENV['APP_ENV'];

        if ($multipleLanguages) {
            $this->multipleLanguages = true;
        }

        $this->themeDir = get_stylesheet_directory_uri();
        $this->themeDirOnServer = get_stylesheet_directory();

        $this->assetManifests['client'] = (array) json_decode(file_get_contents($this->themeDirOnServer . "/dist/frontend-manifest.json"));
        $this->assetManifests['admin'] = (array) json_decode(file_get_contents($this->themeDirOnServer . "/dist/admin-manifest.json"));
    }

    public function configure($options = []) {
        $options = array_merge([
            'asciiEnabled' => false,
            'requireAuthForREST' => false,
            'templates' => [/* array of filepaths */],
            'blocks' => [/* array of filepaths */],
            'blacklistedBlocks' => [],
        ], $options);

        $this->asciiEnabled = $options['asciiEnabled'];

        if ($options['requireAuthForREST']) {
            add_filter('rest_authentication_errors', function($result) {
                if (!empty($result)) {
                    return $result;
                }

                if (!is_user_logged_in()) {
                    return new WP_Error(
                        'rest_not_logged_in',
                        'You are not currently logged in.',
                        ['status' => 401]
                    );
                }

                return $result;
            });
        }

        /**
         * Load & enable blocks that are not blacklisted.
         */
        foreach ($options['blocks'] as $block) {
            $blockName = basename(dirname($block));

            if (in_array($blockName, $options['blacklistedBlocks'])) {
                continue;
            }

            require_once $block;
            $this->enableBlock("\\Evermade\\Blocks\\$blockName");
        }

        /**
         * Load all templates. No blacklist, as templates are not visible to the user.
         */
        foreach ($options['templates'] as $template) {
            require_once $template;
        }

        return $this;
    }

    public function isDev() {
        return $this->appEnvironment === "development";
    }

    public function isStage() {
        return $this->appEnvironment === "staging";
    }

    public function isProd() {
        return $this->appEnvironment === "production";
    }

    public function getFilenameFromManifest(string $name = null, string $manifest = 'client') {
        if (isset($this->assetManifests[$manifest]) && isset($this->assetManifests[$manifest][$name])) {
            $asset = $this->assetManifests[$manifest][$name];

            return $asset;
        }

        $siteurl = get_site_url();
        $message = "Asset $name was not found in manifest $manifest.";

        /**
         * @todo sometimes fails on svg's if manifest has not been generated yet
         */

        //throw new \Exception($message);

        return false;
    }

    public function enqueueFromManifest(string $name = null, string $manifest = 'client', $dependencies = []) {
        $asset = $this->getFilenameFromManifest($name, $manifest);

        if (strpos($asset, '.js') > -1) {
            \wp_enqueue_script(
                "em-$name",
                $this->themeDir . "/dist/$asset",
                $dependencies
            );
        } else if (strpos($asset, '.css') > -1) {
            \wp_enqueue_style(
                "em-$name",
                $this->themeDir . "/dist/$asset",
                $dependencies
            );
        } else {
            throw new \Exception("Asset $name is of unsupported type");
        }

        return $this;
    }

    /**
     * Get current language. If your site isn't multilingual, feel free
     * to change the fallback.
     */
    public function getLanguage() {
        if (!function_exists("pll_current_language")) {
            return "en";
        }

        return \pll_current_language();
    }

    /**
     * Get a translated version (if it exists) of a string.
     */
    public function getText(string $text) {
        if (!function_exists("pll__")) {
            return \__($text, 'everblox');
        }

        return \pll__($text);
    }

    /**
     * Get option from ACF options page. If $this->multipleLanguages is true, will prefix option
     * key with the language slug.
     *
     * @param string $key ACF field key
     * @param string $fallback Optional fallback string
     * @param string $langSlug Optional language slug
     */
    public function getOption(string $key = null, string $fallback = null, string $langSlug = null) {
        if ($this->multipleLanguages) {
            $prefix = $langSlug ?? $this->getLanguage();
            $key = $prefix . "_" . $key;
        }

        $option = \get_field($key, 'option');

        if (!empty($option)) {
            return $option;
        }

        return $fallback;
    }

    /**
     * Initialize a block. Initializing makes block available to flexible content fields
     * and allows it to be rendered.
     *
     * Has to be called before calling $this->enablePagebuilder.
     */
    public function enableBlock($block = '\\Evermade\\Blocks\\Example', ...$params) {
        if (class_exists($block)) {
            $block = new $block(...$params);
            $this->blocks[$block->getBlockName()] = $block;

            return $this;
        }

        throw new \Exception("Block $block not found as a class");
    }

    public function sortBlocks() {
        uasort($this->blocks, function($a, $b) {
            $orderA = $a->getOrder();
            $orderB = $b->getOrder();

            if (is_null($orderA) && is_null($orderB)) return 0;
            if (is_null($orderA)) return 1;
            if (is_null($orderB)) return -1;

            return $orderA - $orderB;
        });
    }

    public function printPagebuilder($params = []) {
        $name = $params['name'] ?? $this->defaultPagebuilderName;
        $data = \get_field($name);

        if (!$data || empty($data)) {
            echo "<!-- Pagebuilder data empty, nothing to print -->";
            return false;
        }

        foreach ($data as $row) {
            $block = $row['acf_fc_layout'];

            if ($this->blocks[$block]) {
                unset($row['acf_fc_layout']);

                $this->blocks[$block]->render($row);
            } else {
              echo "<!-- Block $block missing or blacklisted -->";
            }
        }

        return true;
    }

    public function enablePagebuilder($params = []) {
        $name = $params['name'] ?? $this->defaultPagebuilderName;
        $location = $params['location'] ?? [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default',
                ],
            ],
        ];

        $this->sortBlocks();

        $layouts = [];

        foreach ($this->blocks as $blockName => $instance) {
            $layouts[$blockName] = $instance->getFlexibleContentLayout();
        }

        $acfObj  = [
            'key' => 'group_' . $name,
            'title' => 'Blocks',
            'fields' => [
                [
                    'key' => 'field_' . $name,
                    'label' => 'Blocks',
                    'name' => $name,
                    'type' => 'flexible_content',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'button_label' => 'Add Block',
                    'min' => '',
                    'max' => '',
                    'layouts' => $layouts,
                ],
            ],
            'location' => $location,
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => [
                0 => 'the_content'
            ],
            'active' => 1,
            'description' => '',
            'modified' => 1516178549,
        ];

        acf_add_local_field_group($acfObj);

        return $this;
    }
}
