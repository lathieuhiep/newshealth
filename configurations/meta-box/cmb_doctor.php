<?php
add_action('cmb2_admin_init', 'newshealth_meta_boxes_doctor');
function newshealth_meta_boxes_doctor(): void {
	$cmb = new_cmb2_box(array(
		'id' => 'newshealth_cmb_doctor',
		'title' => esc_html__('Thông tin bổ sung', 'newshealth'),
		'object_types' => array('newshealth_doctor'),
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true,
	));

	$cmb->add_field( array(
		'id'   => 'newshealth_cmb_doctor_specialist',
		'type' => 'text',
		'name' => esc_html__( 'Chuyên khoa', 'newshealth' )
	) );
}