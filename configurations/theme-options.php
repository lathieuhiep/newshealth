<?php
// A Custom function for get an option
if ( ! function_exists( 'newshealth_get_option' ) ) {
	function newshealth_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$newshealth_prefix   = 'options';
	$newshealth_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $newshealth_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'newshealth' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $newshealth_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'newshealth' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'newshealth' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	//
	// -> Create a section general
	CSF::createSection( $newshealth_prefix, array(
		'id'    => 'opt_general_section',
		'title' => esc_html__( 'Cài đặt chung', 'newshealth' ),
		'icon'  => 'fas fa-cog'
	) );

	// Global
	CSF::createSection( $newshealth_prefix, array(
		'parent' => 'opt_general_section',
		'title'  => esc_html__( 'Toàn cục', 'newshealth' ),
		'fields' => array(
			// logo
			array(
				'id'      => 'opt_general_logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Logo', 'newshealth' ),
				'library' => 'image',
				'url'     => false
			),

			// logo mobile
			array(
				'id'      => 'opt_general_logo_mobile',
				'type'    => 'media',
				'title'   => esc_html__( 'Logo Mobile', 'newshealth' ),
				'library' => 'image',
				'url'     => false
			),

			// show loading
			array(
				'id'         => 'opt_general_loading',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Chờ tải trang', 'newshealth' ),
				'text_on'    => esc_html__( 'Có', 'newshealth' ),
				'text_off'   => esc_html__( 'Không', 'newshealth' ),
				'text_width' => 80,
				'default'    => false
			),

			array(
				'id'         => 'opt_general_image_loading',
				'type'       => 'media',
				'title'      => esc_html__( 'Image Loading', 'newshealth' ),
				'subtitle'   => esc_html__( 'Use file .git', 'newshealth' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
				'dependency' => array( 'opt_general_loading', '==', 'true' ),
				'url'        => false
			),
		)
	) );

    // Banner
    CSF::createSection( $newshealth_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Banner', 'newshealth' ),
        'fields' => array(
            // banner pc
            array(
                'id'      => 'opt_general_banner_pc',
                'type'    => 'media',
                'title'   => esc_html__( 'Banner PC', 'newshealth' ),
                'library' => 'image',
                'url'     => false
            ),

            // banner mobile
            array(
                'id'      => 'opt_general_banner_mobile',
                'type'    => 'media',
                'title'   => esc_html__( 'Banner Mobile', 'newshealth' ),
                'library' => 'image',
                'url'     => false
            ),
        )
    ) );

    // Slider
    CSF::createSection( $newshealth_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Slider', 'newshealth' ),
        'fields' => array(
            array(
                'id'    => 'opt_general_slider',
                'type'  => 'gallery',
                'title' => esc_html__( 'Slider', 'newshealth' ),
            ),
        )
    ) );

	// Contact
	CSF::createSection( $newshealth_prefix, array(
		'parent' => 'opt_general_section',
		'title'  => esc_html__( 'Giờ làm - Liên hệ', 'newshealth' ),
		'fields' => array(
            array(
                'id'      => 'opt_general_address',
                'type'    => 'text',
                'title'   => esc_html__( 'Địa chỉ', 'newshealth' ),
                'default' => esc_html__( '180 Trần phú - Phước Ninh', 'newshealth' )
            ),

			array(
				'id'      => 'opt_general_working_time',
				'type'    => 'text',
				'title'   => esc_html__( 'Giờ làm việc', 'newshealth' ),
				'default' => '7h30 - 20h'
			),

			array(
				'id'      => 'opt_general_hotline',
				'type'    => 'text',
				'title'   => esc_html__( 'Hotline', 'newshealth' ),
				'default' => '0888.888.115'
			),

            array(
                'id'      => 'opt_general_link_map',
                'type'    => 'text',
                'title'   => esc_html__( 'Link địa chỉ map', 'newshealth' ),
                'default' => '#'
            ),

			array(
				'id'      => 'opt_general_cf',
				'type'    => 'select',
				'title'   => esc_html__( 'Form liên hệ', 'newshealth' ),
				'desc'    => esc_html__( 'Hiển thị ở header trên mobile', 'newshealth' ),
				'options' => newshealth_get_form_cf7(),
			),

			array(
				'id'      => 'opt_general_medical_appointment_form',
				'type'    => 'select',
				'title'   => esc_html__( 'Form hẹn khám', 'newshealth' ),
				'desc'    => esc_html__( 'Hiển thị khi click button hẹn khám', 'newshealth' ),
				'options' => newshealth_get_form_cf7(),
			),


		)
	) );

    // chat with us
    CSF::createSection( $newshealth_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Chat với chúng tôi', 'newshealth' ),
        'fields' => array(
            array(
                'id'      => 'opt_general_chat_doctor',
                'type'    => 'text',
                'title'   => esc_html__( 'Gặp bác sĩ', 'newshealth' ),
                'default' => '#',
            ),

            array(
                'id'      => 'opt_general_chat_messenger',
                'type'    => 'text',
                'title'   => esc_html__( 'Link messenger', 'newshealth' ),
                'default' => '#',
            ),

            array(
                'id'     => 'opt_general_chat_zalo',
                'type'   => 'fieldset',
                'title'  => esc_html__('ZaLo', 'newshealth'),
                'fields' => array(
                    // select zalo
                    array(
                        'id'      => 'select_zalo',
                        'type'    => 'select',
                        'title'   => esc_html__( 'Kiểu liên hệ', 'newshealth' ),
                        'options' => array(
                            'phone_qr' => esc_html__('Số điện thoại + QR code', 'newshealth'),
                            'link' =>  esc_html__('Zalo OA', 'newshealth'),
                        ),
                        'default' => 'phone_qr'
                    ),

                    // phone + qrcode
                    array(
                        'id'    => 'phone',
                        'type'  => 'text',
                        'title' => esc_html__( 'Số điện thoại', 'newshealth' ),
                        'default' => '0888.888.115',
                        'dependency' => array( 'select_zalo', '==', 'phone_qr' )
                    ),

                    array(
                        'id'    => 'qr_code',
                        'type'  => 'text',
                        'title' => esc_html__( 'Mã QR', 'newshealth' ),
                        'default' => 'i44981jfbz1g',
                        'desc' => esc_html__('Link quét lấy mã:', 'newshealth') . ' https://pageloot.com/vi/quet-ma-qr/',
                        'dependency' => array( 'select_zalo', '==', 'phone_qr' )
                    ),

                    // link
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__( 'Link', 'newshealth' ),
                        'default' => 'https://zalo.me/4019565536704794124',
                        'dependency' => array( 'select_zalo', '==', 'link' ),
                    ),
                ),
            ),
        )
    ) );

	//
	// Create a section menu
	CSF::createSection( $newshealth_prefix, array(
		'title'  => esc_html__( 'Menu', 'newshealth' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'newshealth' ),
				'text_on'    => esc_html__( 'Yes', 'newshealth' ),
				'text_off'   => esc_html__( 'No', 'newshealth' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $newshealth_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'newshealth' ),
	) );

	// Category Post
	CSF::createSection( $newshealth_prefix, array(
		'parent'      => 'opt_post_section',
		'title'       => esc_html__( 'Category', 'newshealth' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'newshealth' ),
		'fields'      => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'newshealth' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'newshealth' ),
					'left'  => esc_html__( 'Left', 'newshealth' ),
					'right' => esc_html__( 'Right', 'newshealth' ),
				),
				'default' => 'right'
			),

            // layout
            array(
                'id'        => 'opt_post_cat_grid',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Grid', 'newshealth' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'newshealth' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'newshealth' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'newshealth' ),
                        'default'    => 4,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'newshealth' ),
                        'default'    => 4,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
            ),
		)
	) );

	// Single Post
	CSF::createSection( $newshealth_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'newshealth' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'newshealth' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'newshealth' ),
					'left'  => esc_html__( 'Left', 'newshealth' ),
					'right' => esc_html__( 'Right', 'newshealth' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'newshealth' ),
				'text_on'    => esc_html__( 'Yes', 'newshealth' ),
				'text_off'   => esc_html__( 'No', 'newshealth' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'newshealth' ),
				'default' => 6,
			),

			array(
				'id'      => 'opt_post_single_contact_form',
				'type'    => 'select',
				'title'   => esc_html__( 'Form liên hệ', 'newshealth' ),
				'options' => newshealth_get_form_cf7(),
			),
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $newshealth_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'newshealth' ),
	) );

	// footer columns
    CSF::createSection( $newshealth_prefix, array(
        'parent' => 'opt_footer_section',
        'title'  => esc_html__( 'Columns Sidebar', 'newshealth' ),
        'fields' => array(
            // select columns
            array(
                'id'      => 'opt_footer_columns',
                'type'    => 'select',
                'title'   => esc_html__( 'Number of footer columns', 'newshealth' ),
                'options' => array(
                    '0' => esc_html__( 'Hide', 'newshealth' ),
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '4'
            ),

            // column width 1
            array(
                'id'        => 'opt_footer_column_width_1',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 1', 'newshealth' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'newshealth' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'newshealth' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', '!=', '0' )
            ),

            // column width 2
            array(
                'id'        => 'opt_footer_column_width_2',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 2', 'newshealth' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'newshealth' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'newshealth' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
            ),

            // column width 3
            array(
                'id'        => 'opt_footer_column_width_3',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'newshealth' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'newshealth' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'newshealth' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
            ),

            // column width 4
            array(
                'id'        => 'opt_footer_column_width_4',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'newshealth' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'newshealth' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'newshealth' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥1200px', 'newshealth' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
            ),
        )
    ) );

	//
	// -> Create a section add code
	CSF::createSection( $newshealth_prefix, array(
		'id'    => 'opt_add_code_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Thêm code', 'newshealth' ),
	) );

	// add code header
	CSF::createSection( $newshealth_prefix, array(
		'parent' => 'opt_add_code_section',
		'title'  => esc_html__( 'Thêm vào header', 'newshealth' ),
		'fields' => array(
			array(
				'id'       => 'opt_add_code_header',
				'type'     => 'code_editor',
				'title'    => esc_html__('Code', 'newshealth'),
				'sanitize' => false,
				'settings' => array(
					'theme'  => 'monokai'
				),
			),
		)
	) );

	// add code footer
	CSF::createSection( $newshealth_prefix, array(
		'parent' => 'opt_add_code_section',
		'title'  => esc_html__( 'Thêm vào footer', 'newshealth' ),
		'fields' => array(
			array(
				'id'       => 'opt_add_code_footer',
				'type'     => 'code_editor',
				'title'    => esc_html__('Code', 'newshealth'),
				'sanitize' => false,
				'settings' => array(
					'theme'  => 'monokai'
				),
			),
		)
	) );
}