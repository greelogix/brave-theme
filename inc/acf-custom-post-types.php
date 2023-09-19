<?php


add_action('init', function () {
    register_post_type('instructor', array(
        'labels' => array(
            'name' => 'Instructors',
            'singular_name' => 'Instructor',
            'menu_name' => 'Instructors',
            'all_items' => 'All Instructors',
            'edit_item' => 'Edit Instructor',
            'view_item' => 'View Instructor',
            'view_items' => 'View Instructors',
            'add_new_item' => 'Add New Instructor',
            'new_item' => 'New Instructor',
            'parent_item_colon' => 'Parent Instructor:',
            'search_items' => 'Search Instructors',
            'not_found' => 'No instructors found',
            'not_found_in_trash' => 'No instructors found in Trash',
            'archives' => 'Instructor Archives',
            'attributes' => 'Instructor Attributes',
            'insert_into_item' => 'Insert into instructor',
            'uploaded_to_this_item' => 'Uploaded to this instructor',
            'filter_items_list' => 'Filter instructors list',
            'filter_by_date' => 'Filter instructors by date',
            'items_list_navigation' => 'Instructors list navigation',
            'items_list' => 'Instructors list',
            'item_published' => 'Instructor published.',
            'item_published_privately' => 'Instructor published privately.',
            'item_reverted_to_draft' => 'Instructor reverted to draft.',
            'item_scheduled' => 'Instructor scheduled.',
            'item_updated' => 'Instructor updated.',
            'item_link' => 'Instructor Link',
            'item_link_description' => 'A link to a instructor.',
        ),
        'public' => true,
        'show_in_rest' => true,
        'supports' => array(
            0 => 'title',
            1 => 'editor',
            2 => 'thumbnail',
        ),
        'delete_with_user' => false,
        // icon
        'menu_icon' => 'dashicons-groups',
        // position
        'menu_position' => 8,
    ));

    register_post_type('program', array(
        'labels' => array(
            'name' => 'Programs',
            'singular_name' => 'Program',
            'menu_name' => 'Programs',
            'all_items' => 'All Programs',
            'edit_item' => 'Edit Program',
            'view_item' => 'View Program',
            'view_items' => 'View Programs',
            'add_new_item' => 'Add New Program',
            'new_item' => 'New Program',
            'parent_item_colon' => 'Parent Program:',
            'search_items' => 'Search Programs',
            'not_found' => 'No programs found',
            'not_found_in_trash' => 'No programs found in Trash',
            'archives' => 'Program Archives',
            'attributes' => 'Program Attributes',
            'insert_into_item' => 'Insert into program',
            'uploaded_to_this_item' => 'Uploaded to this program',
            'filter_items_list' => 'Filter programs list',
            'filter_by_date' => 'Filter programs by date',
            'items_list_navigation' => 'Programs list navigation',
            'items_list' => 'Programs list',
            'item_published' => 'Program published.',
            'item_published_privately' => 'Program published privately.',
            'item_reverted_to_draft' => 'Program reverted to draft.',
            'item_scheduled' => 'Program scheduled.',
            'item_updated' => 'Program updated.',
            'item_link' => 'Program Link',
            'item_link_description' => 'A link to a program.',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array(
            0 => 'title',
            1 => 'editor',
            2 => 'thumbnail',
        ),
        'delete_with_user' => false,
        'menu_icon' => 'dashicons-welcome-learn-more',
        // position
        'menu_position' => 7,
    ));

    // cta
});
