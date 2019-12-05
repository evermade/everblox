<?php get_header(); ?>

<section class="l-styleguide style">
    <div class="l-styleguide__container wysiwyg" data-style-color>

        <h5>wysiwyg<strong> -wrapper adds margin around each html element making articles look beautiful.</strong></h5>
        <hr>
        <br><br>
        <div class="wysiwyg">
            <?php for ($i=1; $i<7; $i++): ?>
                <h1 class="h<?php echo $i;?>">H<?php echo $i;?>: This is a testing text for a headline and it is actually very long so make sure it line-height looks good.</h1>
                <p>Lorem ipsum dolor sit amet, <a href="">consectetur adipisicing</a> elit. Natus culpa quibusdam beatae perspiciatis dolorum reprehenderit ab rerum enim assumenda fugit excepturi neque, amet cumque quasi praesentium accusantium, tempore optio corporis.</p>
                <?php if ($i == 1) {
                    ?>
                <p>Lorem ipsum dolor sit amet, <a href="">consectetur adipisicing</a> elit. Natus culpa quibusdam beatae perspiciatis dolorum reprehenderit ab rerum enim assumenda fugit excepturi neque, amet cumque quasi praesentium accusantium, tempore optio corporis.</p>
                <?php
                } ?>
                <?php endfor; ?>
                <hr>
                <?php foreach (['lg', 'md', 'sm'] as $size): ?>
                <p class="text-<?php echo $size;?>">Text-
                    <?php echo $size;?> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex beatae quaerat debitis vitae mollitia neque fuga a, voluptatem sunt similique atque placeat quam nulla maiores quis iure voluptate ratione soluta!</p>
                <?php endforeach ?>
                <h1>This is the primary heading and there should only be one of these per page</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum inventore in alias itaque rem. Quis fugit quasi quia placeat aut qui expedita ullam veritatis. Excepturi error neque laborum quod amet.</p>
                <p><a href="" class="c-btn">Button</a> <a href="" class="c-btn c-btn--full">Button</a></p>
                <p class="accent">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum inventore in alias itaque rem. Quis fugit quasi quia placeat aut qui expedita ullam veritatis. Excepturi error neque laborum quod amet.</p>
                <ul>
                    <li>This is a list item</li>
                    <li>So is this - there could be more</li>
                    <li>Make sure to style list items to:
                        <ul>
                            <li>Not forgetting child list items</li>
                            <li>Not forgetting child list items</li>
                            <li>Not forgetting child list items</li>
                            <li>Not forgetting child list items</li>
                        </ul>
                    </li>
                    <li>A couple more</li>
                    <li>top level list items</li>
                </ul>
                <p>Don't forget <strong>Ordered lists</strong>:</p>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.
                        <ol>
                            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                            <li>Aliquam tincidunt mauris eu risus.</li>
                        </ol>
                    </li>
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>
                <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <table>
                    <tr>
                        <th>Table Heading</th>
                        <th>Table Heading</th>
                    </tr>
                    <tr>
                        <td>table data</td>
                        <td>table data</td>
                    </tr>
                    <tr>
                        <td>table data</td>
                        <td>table data</td>
                    </tr>
                    <tr>
                        <td>table data</td>
                        <td>table data</td>
                    </tr>
                    <tr>
                        <td>table data</td>
                        <td>table data</td>
                    </tr>
                </table>
                <h3>A sub heading which is not as important as the second, but should be used with consideration</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <blockquote>
                    <p>“Ooh - a blockquote! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.”</p>
                </blockquote>
                <h4>A sub heading which is not as important as the second, but should be used with consideration</h4>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
<pre>
<code>
#header h1 a {
    display: block;
    width: 300px;
    height: 80px;
}
</code>
</pre>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <h5>A sub heading which is not as important as the second, but should be used with consideration</h5>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <h6>This heading plays a relatively small bit part role, if you use it at all</h6>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <!-- images -->
                <p><img class="size-large alignnone" src="https://picsum.photos/1024/768?image=100" alt=""></p>
                <p><img class="size-large aligncenter" src="https://picsum.photos/1024/768?image=100" alt=""></p>
                <div class="wp-caption alignnone">
                    <img class="size-large" src="https://picsum.photos/1024/768?image=100" alt="">
                    <p class="wp-caption-text">Image with caption and align none</p>
                </div>
                <div style="width: 640px" class="wp-caption aligncenter">
                    <img class="size-large" src="https://picsum.photos/1024/768?image=100" alt="">
                    <p class="wp-caption-text">Image with caption and align center</p>
                </div>

                <img class="size-large alignleft" src="https://picsum.photos/1024/768?image=100" alt="">
                <p>Rub face on everything hunt by meowing loudly at 5am next to human slave food dispenser yet kitty power! so hack up furballs leave dead animals as gifts, and inspect anything brought into the house. Intently stare at the same spot shake treat bag, yet make meme, make cute face. Hunt by meowing loudly at 5am next to human slave food dispenser all of a sudden cat goes crazy, but poop in the plant pot. If it fits, i sits jump off balcony, onto stranger's head swat at dog, or love to play with owner's hair tie poop on grasses yet chase dog then run away. Rub face on everything white cat sleeps on a black shirt stick butt in face throwup on your pillow. The dog smells bad knock over christmas tree destroy the blinds. Kitty power! knock over christmas tree for chew iPad power cord cat is love, cat is life for spread kitty litter all over house i am the best. Lick arm hair sleep in the bathroom sink yet stare at the wall, play with food and get confused by dust claw drapes roll on the floor purring your whiskers off under the bed.</p>
                <p>Rub face on everything hunt by meowing loudly at 5am next to human slave food dispenser yet kitty power! so hack up furballs leave dead animals as gifts, and inspect anything brought into the house. Intently stare at the same spot shake treat bag, yet make meme, make cute face. Hunt by meowing loudly at 5am next to human slave food dispenser all of a sudden cat goes crazy, but poop in the plant pot. If it fits, i sits jump off balcony, onto stranger's head swat at dog, or love to play with owner's hair tie poop on grasses yet chase dog then run away. Rub face on everything white cat sleeps on a black shirt stick butt in face throwup on your pillow. The dog smells bad knock over christmas tree destroy the blinds. Kitty power! knock over christmas tree for chew iPad power cord cat is love, cat is life for spread kitty litter all over house i am the best. Lick arm hair sleep in the bathroom sink yet stare at the wall, play with food and get confused by dust claw drapes roll on the floor purring your whiskers off under the bed.</p>

                <img class="size-large alignright" src="https://picsum.photos/1024/768?image=100" alt="">
                <p>Rub face on everything hunt by meowing loudly at 5am next to human slave food dispenser yet kitty power! so hack up furballs leave dead animals as gifts, and inspect anything brought into the house. Intently stare at the same spot shake treat bag, yet make meme, make cute face. Hunt by meowing loudly at 5am next to human slave food dispenser all of a sudden cat goes crazy, but poop in the plant pot. If it fits, i sits jump off balcony, onto stranger's head swat at dog, or love to play with owner's hair tie poop on grasses yet chase dog then run away. Rub face on everything white cat sleeps on a black shirt stick butt in face throwup on your pillow. The dog smells bad knock over christmas tree destroy the blinds. Kitty power! knock over christmas tree for chew iPad power cord cat is love, cat is life for spread kitty litter all over house i am the best. Lick arm hair sleep in the bathroom sink yet stare at the wall, play with food and get confused by dust claw drapes roll on the floor purring your whiskers off under the bed.</p>
                <p>Rub face on everything hunt by meowing loudly at 5am next to human slave food dispenser yet kitty power! so hack up furballs leave dead animals as gifts, and inspect anything brought into the house. Intently stare at the same spot shake treat bag, yet make meme, make cute face. Hunt by meowing loudly at 5am next to human slave food dispenser all of a sudden cat goes crazy, but poop in the plant pot. If it fits, i sits jump off balcony, onto stranger's head swat at dog, or love to play with owner's hair tie poop on grasses yet chase dog then run away. Rub face on everything white cat sleeps on a black shirt stick butt in face throwup on your pillow. The dog smells bad knock over christmas tree destroy the blinds. Kitty power! knock over christmas tree for chew iPad power cord cat is love, cat is life for spread kitty litter all over house i am the best. Lick arm hair sleep in the bathroom sink yet stare at the wall, play with food and get confused by dust claw drapes roll on the floor purring your whiskers off under the bed.</p>
        </div>

    </div>
</section>

<?php get_footer();
