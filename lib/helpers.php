<?php
namespace Evermade\Helpers;

/**
 * Prints PHP into the JavaScript to help with debugging.
 *
 * @param $data Data that is shown in the console
 */

function console($data) {
    if ($data) {
        $encodedData = json_encode($data);
        echo "<script>console.log($encodedData);</script>";
    }
}

/**
 * Prints all given arguments using var_dump()
 */
 function dump(){
    $args = func_get_args();
    echo '<pre>';
    foreach($args as $arg){
        var_dump($arg);
    }
    echo '</pre>';
}

/**
 * Prints all given arguments and then stops executing the script
 * Similar to dump() but easier to see find the actual output.
 */
function dumpAndDie(){
    $args = func_get_args();
    echo '<pre>';
    foreach($args as $arg){
        var_dump($arg);
    }
    echo '</pre>';
    die();
}

/**
 * Gets unique post types from an array of items.
 *
 * @param $items Array of the posts
 */

function getUniquePostTypes(array $items = []) {
    $postTypes = [];

    foreach ($items as $item) {

        /**
         * This is a bit weird, there's also the possibility
         * to pass non-posts as items, so for now just flagging
         * those as "custom".
         *
         * @todo Have a look if there's a better way to do this.
         */

        if (is_array($item)) {
            $postType = 'custom';
        } else {
            $postType = get_post_type($item);
        }

        if (!in_array($postType, $postTypes)) {
            $postTypes[] = $postType;
        }
    }

    return $postTypes;
}