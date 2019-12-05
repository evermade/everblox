<?php
/**
 * The purpose of this file is to provide quick, non-namespaced
 * shortcuts for functions commonly used in development.
 *
 * DON'T use this file for helpers, use helpers.php instead.
 *
 * DON'T use any of these functions permanently in a project,
 * they are only ment to help you during development.
 */

function console($data) {
    \Evermade\Helpers\console($data);
}

function d(){
    call_user_func_array('\Evermade\Helpers\dump', func_get_args());
}

function dd(){
    call_user_func_array('\Evermade\Helpers\dumpAndDie', func_get_args());
}
