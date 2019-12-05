<?php
namespace Evermade;

/**
 * Block base class. Used to define shared behaviour between all blocks.
 */
abstract class Block {
    protected $customData = [];
    protected $blockName = null;
    protected $order = 0;

    /**
     * Load all files and data required by the block. If your block doesn't need
     * other files or data, don't redefine the constructor in the block itself.
     */
    public function __construct() {
        global $app;

        $name = $this->getBlockName();
        $template = "{$app->themeDirOnServer}/lib/blocks/{$name}/view.php";
        $order = $this->getOrder();

        require_once $template;
    }

    /**
     * Get block name from the class name. __CLASS__ can't be used because it
     * includes the namespace as well, and ACF keys break if they contain backslashes (\).
     *
     * You shouldn't override this unless you really know what you're doing.
     */
    public function getBlockName() {
        if (!$this->blockName) {
          $this->blockName = (new \ReflectionClass($this))->getShortName();
        }

        return $this->blockName;
    }

    /**
     * Get the order of the block in the ACF popup list.
     */

    public function getOrder() {
        return $this->order;
    }

    /**
     * Set the order of the block in the ACF popup list.
     *
     * @param int $order Order number of the block (ascending)
     */

    public function setOrder(int $order = null) {
        if ($order) {
            $this->order = $order;
        }
    }

    /**
     * Get custom data from block
     *
     * @param string $key Key data is stored under
     */
    public function get(string $key = null) {
        return $this->customData[$key];
    }

    /**
     * Set custom data for block
     *
     * @param string $key Key data is stored under
     * @param $data
     */
    public function set(string $key = null, $data = null) {
        $this->customData[$key] = $data;
    }

    /**
     * This function is used to define a flexible content layout for your block.
     * You have to always define it. You can use the GUI in ACF to create the fields
     * and export them with the ACF PHP export functionality.
     *
     * See other blocks for help if you're lost on what to copy.
     */
    abstract public function getFlexibleContentLayout();

    /**
     * Render the block template. By default, it should be located
     * in view.php, under the block folder.
     *
     * There's probably no need to override this method in your block.
     */
    public function render(...$params) {
        $block = $this->getBlockName();
        $template = "\\Evermade\\Blocks\\$block\\template";

        return $template(...$params);
    }

    /**
     * Render the block template, but instead of outputting it immediately (which causes headers to be sent),
     * use output buffer to capture the result.
     */
    public function captureRender(...$params) {
        \ob_start();
        $this->render(...$params);
        return \ob_get_clean();
    }
}
