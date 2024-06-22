<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Title_Number_List extends Widget_Base
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
		return 'newshealth-title-number-list';
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
		return esc_html__('Title number list', 'newshealth');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-text';
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
		return ['image', 'text', 'list'];
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
		// list content
		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'Danh sách', 'newshealth' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tiêu đề', 'newshealth' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tiêu đề' , 'newshealth' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'newshealth' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Tiêu đề #1', 'newshealth' ),
					],
					[
						'list_title' => __( 'Tiêu đề #2', 'newshealth' ),
					],
					[
						'list_title' => __( 'Tiêu đề #3', 'newshealth' ),
					],
					[
						'list_title' => __( 'Tiêu đề #4', 'newshealth' ),
					],
					[
						'list_title' => __( 'Tiêu đề #5', 'newshealth' ),
					],
					[
						'list_title' => __( 'Tiêu đề #6', 'newshealth' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// style layout
		$this->start_controls_section(
			'style_layout_section',
			[
				'label' => esc_html__( 'Bố cục', 'newshealth' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'layout_padding',
			[
				'label' => esc_html__( 'Padding', 'newshealth' ),
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
					'{{WRAPPER}} .element-title-number-list__warp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layout_background_color',
			[
				'label' => esc_html__( 'Màu nền', 'newshealth' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-title-number-list__warp' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'selector' => '{{WRAPPER}} .element-title-number-list__warp',
			]
		);

		$this->add_control(
			'layout_border_radius',
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
					'{{WRAPPER}} .element-title-number-list__warp' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// style title
		$this->start_controls_section(
			'style_title_section',
			[
				'label' => esc_html__( 'Tiêu đề', 'newshealth' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_title_color',
			[
				'label' => esc_html__( 'Color', 'newshealth' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-title-number-list__warp .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_title_typography',
				'selector' => '{{WRAPPER}} .element-title-number-list__warp .title',
			]
		);

		$this->end_controls_section();

		// style number
		$this->start_controls_section(
			'style_number_section',
			[
				'label' => esc_html__( 'Số', 'newshealth' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_number_color',
			[
				'label' => esc_html__( 'Color', 'newshealth' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-title-number-list__warp .number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_number_typography',
				'selector' => '{{WRAPPER}} .element-title-number-list__warp .number',
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
        <div class="element-title-number-list">
			<?php if ( $settings['list'] ) : ?>
                <div class="element-title-number-list__warp">
					<?php foreach ( $settings['list'] as $key => $item) : ?>

                        <div class="item repeater-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <strong class="number f-family-heading f-family-body">
								<?php echo esc_html( addZeroBeforeNumber($key + 1) ); ?>
                            </strong>

                            <h4 class="title">
								<?php echo esc_html( $item['list_title'] ); ?>
                            </h4>
                        </div>

					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
		<?php
	}
}