<?php
namespace Evermade\PostTypes;

// Story post type

function storySetup()
{
    $labels = array(
        'name'                  => 'Stories',
        'singular_name'         => 'Story',
        'add_new'               => 'Add New Story',
        'add_new_item'          => 'Add New Story',
        'edit_item'             => 'Edit Story',
        'new_item'              => 'New Story',
        'all_items'             => 'All Stories',
        'view_item'             => 'View Story',
        'search_items'          => 'Search Stories',
        'not_found'             => 'No Stories found',
        'not_found_in_trash'    => 'No Stories found in the Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Stories',
    );

    $args = array(
        'labels'                => $labels,
        'description'           => 'This is the story post type that replaces the default posts.',
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'menu_icon'             => 'dashicons-format-aside',
        'rewrite'               => array(
            'slug' => 'story'
        )
    );

    register_post_type('story', $args);
}

// Contact post type

function contactSetup()
{
    $labels = array(
        'name'                  => 'Contact',
        'singular_name'         => 'Contact',
        'add_new'               => 'Add New Contact',
        'add_new_item'          => 'Add New Contact',
        'edit_item'             => 'Edit Contact',
        'new_item'              => 'New Contact',
        'all_items'             => 'All Contacts',
        'view_item'             => 'View Contact',
        'search_items'          => 'Search Contacts',
        'not_found'             => 'No Contacts found',
        'not_found_in_trash'    => 'No Contacts found in the Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Contacts',
    );

    $args = array(
        'labels'                => $labels,
        'description'           => 'This is the contact post type.',
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array('title'),
        'taxonomies'            => array(),
        'has_archive'           => false,
        'publicly_queryable'    => false,
        'exclude_from_search'   => true,
        'menu_icon'             => 'dashicons-groups'
    );

    register_post_type('contact', $args);
}

// Enable post type

function setCustomTypes()
{
    storySetup();
    contactSetup();
}

add_action('init', 'Evermade\PostTypes\setCustomTypes');
