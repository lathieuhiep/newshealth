<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Contact_Us extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'newshealth-contact-us';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Contact Us', 'newshealth');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-mail';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['contact'];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['my-theme'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @access protected
     */
    protected function register_controls(): void
    {
        // layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'newshealth' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__( 'Cột', 'newshealth' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_column_gap',
            [
                'label' => esc_html__( 'Grid column gap', 'newshealth' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_row_gap',
            [
                'label' => esc_html__( 'Grid row gap', 'newshealth' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'newshealth'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_background_item',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .element-contact-us__list {{CURRENT_ITEM}}.item',
            ]
        );

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__('Tiêu đề', 'newshealth'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tiêu đề', 'newshealth'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_title_color',
            [
                'label' => esc_html__( 'Màu tiêu đề', 'newshealth' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list {{CURRENT_ITEM}} .item__body .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'list_show_title',
            [
                'label' => esc_html__('Hiện tiêu đề', 'newshealth'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Có', 'newshealth'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('Không', 'newshealth'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'hide'
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__('Chọn ảnh', 'newshealth'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__('Nội dung', 'newshealth'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', 'newshealth'),
                'show_label' => false,
            ]
        );

        $repeater->add_responsive_control(
            'list_content_font_size',
            [
                'label' => esc_html__( 'Kích cõ chữ nội dung', 'newshealth' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list {{CURRENT_ITEM}} .item__body .desc' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'list_content_color',
            [
                'label' => esc_html__( 'Màu chữ nội dung', 'newshealth' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-contact-us__list {{CURRENT_ITEM}} .item__body .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'contact_list',
            [
                'label' => esc_html__('Contact List', 'newshealth'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__('Title #1', 'newshealth'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'newshealth'),
                    ],
                    [
                        'list_title' => esc_html__('Title #2', 'newshealth'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'newshealth'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // box item style
        $this->start_controls_section(
            'box_item_style_section',
            [
                'label' => esc_html__( 'Hộp chứa', 'newshealth' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_item_background_color',
            [
                'label'     =>  esc_html__( 'Màu nền', 'newshealth' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-contact-us__list .item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'box_item_border',
			    'selector' => '{{WRAPPER}} .element-contact-us__list .item',
		    ]
	    );

	    $this->add_control(
		    'box_item_border_radius',
		    [
			    'label' => esc_html__( 'Border radius', 'newshealth' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
			    'default' => [
				    'top' => '',
				    'right' => '',
				    'bottom' => '',
				    'left' => '',
				    'unit' => 'px',
				    'isLinked' => true,
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .element-contact-us__list .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'newshealth' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'newshealth' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-contact-us__list .item__body .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'newshealth' ),
                'selector' => '{{WRAPPER}} .element-contact-us__list .item__body .title',
            ]
        );

        $this->end_controls_section();

        // content style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'newshealth' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'newshealth' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-contact-us__list .item__body .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'newshealth' ),
                'selector' => '{{WRAPPER}} .element-contact-us__list .item__body .desc',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="element-contact-us">
            <?php if ($settings['contact_list']) : ?>

                <div class="element-contact-us__list">
                    <?php foreach ($settings['contact_list'] as $item): ?>
                        <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <div class="item__image">
                                <?php echo wp_get_attachment_image($item['list_image']['id'], 'medium'); ?>
                            </div>

                            <div class="item__body">
                                <div class="desc">
                                    <?php echo wpautop( $item['list_content'] ); ?>
                                </div>

                                <?php if ( $item['list_show_title'] == 'show' ) : ?>
                                    <h3 class="title">
                                        <?php echo esc_html( $item['list_title'] ); ?>
                                    </h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>
        <?php
    }
}