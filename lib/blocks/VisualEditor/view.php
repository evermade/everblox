<?php
namespace Evermade\Blocks\VisualEditor;

use Evermade\Templates;

function template($data = []) {
    $data = Templates\params([
        'content' => '',
        'columns' => [],
        'spacing' => 'block',
        'one_column_layout' => 'narrow-left',
        'two_column_layout' => '50-50',
        'three_column_layout' => '33-33-33',
        'four_column_layout' => '50-50',
    ], $data);

    $layoutData = [
        "data-one-layout='$data[one_column_layout]'",
        "data-two-layout='$data[two_column_layout]'",
        "data-three-layout='$data[three_column_layout]'",
        "data-four-layout='$data[four_column_layout]'",
    ];

    $layoutClass = Templates\className(
        "l-visual-editor",
        "collapse",
        "l-visual-editor--spacing-$data[spacing]"
    ); ?>

    <section <?= $layoutClass ?>>
        <div class="l-visual-editor__container">
            <div class="l-visual-editor__items" <?= implode(" ", $layoutData) ?> data-columns="<?= count($data['columns']) ?>">
                <?php foreach ($data['columns'] as $key => $column) :
                    $itemClass = Templates\className(
                        "l-visual-editor__item",
                        "l-visual-editor__item--style-$column[style]",
                        "wysiwyg"
                    );

                    $itemData = $column['style'] === 'none' ? "data-style-color" : ""; ?>

                    <div <?= $itemClass ?> <?= $itemData ?>>
                        <?php if ($column['style'] === 'box') : ?>
                            <div class="c-content-box">
                                <?= $column['content'] ?>
                            </div>
                        <?php else : ?>
                            <?= $column['content'] ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
}
