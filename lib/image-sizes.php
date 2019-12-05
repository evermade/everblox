<?php

// Remove default image sizes
remove_image_size('small');
remove_image_size('medium');
remove_image_size('large');
remove_image_size('medium_large');

// Add new image sizes
add_image_size('placeholder', 10, 10);
add_image_size('extra-small', 450, 450);
add_image_size('small', 800, 800);
add_image_size('medium', 1366, 768);
add_image_size('large', 1920, 1080);
add_image_size('extra-large', 2560, 1440);

// Add image sizes to admin Media size selector
add_filter('image_size_names_choose', function ($sizes) {
    return array(
        'thumbnail' => 'Thumbnail',
        'extra-small' => 'Extra Small',
        'small' => 'Small',
        'medium' => 'Medium',
        'large' => 'Large',
        'extra-large' => 'Extra Large',
        'full' => 'Full Size'
    );
});

