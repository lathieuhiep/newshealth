<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'newshealth_create_doctor', 10);

function newshealth_create_doctor(): void
{
    /* Start post type template */
    $labels = array(
        'name' => _x('Đội ngũ bác sĩ', 'post type general name', 'newshealth'),
        'singular_name' => _x('Đội ngũ bác sĩ', 'post type singular name', 'newshealth'),
        'menu_name' => _x('Đội ngũ bác sĩ', 'admin menu', 'newshealth'),
        'name_admin_bar' => _x('Danh sách bác sĩ', 'add new on admin bar', 'newshealth'),
        'add_new' => _x('Thêm mới', 'Bác sĩ', 'newshealth'),
        'add_new_item' => esc_html__('Thêm', 'newshealth'),
        'edit_item' => esc_html__('Sửa', 'newshealth'),
        'new_item' => esc_html__('Bác sĩ mới', 'newshealth'),
        'view_item' => esc_html__('Xem', 'newshealth'),
        'all_items' => esc_html__('Tất cả', 'newshealth'),
        'search_items' => esc_html__('Tìm kiếm', 'newshealth'),
        'not_found' => esc_html__('Không tìm thấy', 'newshealth'),
        'not_found_in_trash' => esc_html__('Không tìm thấy trong thùng rác', 'newshealth'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-groups',
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'bac-si'),
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('newshealth_doctor', $args);
    /* End post type template */
}