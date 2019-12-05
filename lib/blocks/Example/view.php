<?php
namespace Evermade\Blocks\Example;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params(['default' => 'text'], $data); ?>

    <section>
        Example
        <pre>
          <?php print_r($data); ?>
        </pre>
    </section>
    <?php
}

