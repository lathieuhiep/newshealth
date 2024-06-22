<?php
add_action('cmb2_admin_init', 'newshealth_post_meta_boxes');
function newshealth_post_meta_boxes(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'newshealth_cmb_post',
        'title' => esc_html__('Option metabox', 'newshealth'),
        'object_types' => array('post'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'newshealth_cmb_post_title',
        'name' => esc_html__( 'Test Title', 'newshealth' ),
        'type' => 'title',
        'desc' => esc_html__( 'This is a title description', 'newshealth' ),
    ) );
}